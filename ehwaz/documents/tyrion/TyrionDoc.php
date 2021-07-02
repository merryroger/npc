<?php
/**
 * Uses tyrion-xml-metadoc data format by Ehwaz Raido ( http://www.ehwaz.ru )
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwas\documents\tyrion;


class TyrionDoc
{

    use \ehwaz\traits\XMLParsers;
    use \ehwaz\traits\Transcoders;
    use \ehwaz\traits\Evaluators;

    const ERR_FILE_NOT_FOUND = 0xed01;
    const ERR_FILE_EMPTY_OR_CORRUPTED = 0xed02;

    protected $contents;
    protected $parameters;
    protected $docheader;
    protected $colontitule;
    protected $stamps;
    protected $xslt;
    protected $buffer;
    protected $error;

    protected $page;

    public function __construct()
    {
        $this->reset();

        $this->page = 1;
    }

    public function loadDocument($doc_path = '', $base_dir = __DIR__): void
    {
        $this->reset();

        if (!$this->loadDocumentContents($base_dir . "/{$doc_path}")) {
            return;
        }

    }

    public function getContents(): string
    {
        return $this->contents;
    }

    protected function parseDocument(): void
    {
        if ($this->error)
            return;

        $this->setDocumentParameters();

        $pages = intval($this->parameters['pages']);
        if ($this->page < 1) {
            $this->page = 1;
        } elseif ($this->page > $pages) {
            $this->page = $pages;
        }

        if (isset($this->parameters['colontitules'])) {
            $this->makeColontitule();
        }

        if ($this->page == 1) {
            $this->loadDocHeader();
        }

        if ($this->page == 1 && isset($this->parameters['stamps'])) {
            $this->loadDocStamps();
        }
    }

    protected function setDocumentParameters(): void
    {
        $this->parameters = [];
        if ($plainParameters = $this->pickTagSubdata('parameters', $this->buffer)) {
            $encodeArray = [
                1 => $this->pickTagSubdata('encoding', $plainParameters),
                2 => &$this->buffer,
                3 => &$plainParameters
            ];
            $this->recode($encodeArray);
            unset($encodeArray);

            $this->parameters = $this->easeParser($plainParameters);
            unset($plainParameters);
        }

    }

    protected function loadDocumentContents($path): bool
    {
        if (!file_exists($path)) {
            $this->error = $this::ERR_FILE_NOT_FOUND;
            return false;
        }

        if (!$this->buffer = file_get_contents($path)) {
            $this->error = $this::ERR_FILE_EMPTY_OR_CORRUPTED;
            return false;
        }

        return true;
    }

    protected function makeColontitule(): void
    {
        $cc = [];
        $tag = 'colontitule';
        $pages = intval($this->parameters['pages']);
        $this->colontitule = '';

        if ($pages > 1 && isset($this->xslt[$tag])) {
            for ($pn = 1; $pn <= $pages; $pn++) {
                $cc[] = $this->postProcess($this->xslt[$tag], $pn, $this->page != $pn);
//                if ($this->page != $pn) {
//                    $cc[] = '<span class="pagenum"><a href="' . $this->parameters['docuri'] . 'page' . $pn . '.html">' . $pn . '</a></span>';
//                } else {
//                    $cc[] = '<span class="pagenum">' . $pn . '</span>';
//                }
            }

            $this->colontitule = join('', $cc);
            unset($cc);
        }
    }

    protected function loadDocHeader(): void
    {
        $tag = 'docheader';
        if (!$dh = $this->pickTagSubdata($tag, $this->buffer))
            $dh = $this->parameters['docname'];

        $this->docheader = (isset($this->xslt[$tag])) ? $this->postProcess($this->xslt[$tag], $dh) : $dh;
    }

    protected function loadDocStamps(): void
    {
        $tag = 'stamp';
        if (!$stamp = $this->pickTagSubdata($tag, $this->buffer))
            return;

        if (isset($this->xslt[$tag])) {
            $this->stamps = $this->postProcess($this->xslt[$tag], $stamp);
        }
    }

    protected function loadPage(): void
    {
        $this->contents = $this->tagParser('page', ['number' => $this->page], $this->buffer, true)[1];
    }

    public function getError(): int
    {
        return $this->error;
    }

    protected function reset(): void
    {
        $this->error = 0;
        $this->contents = '';
        $this->docheader = '';
        $this->colontitule = '';
        $this->stamps = '';
        $this->xslt = [];

        unset($this->parameters, $this->buffer);
    }

    public function __destruct()
    {
        $this->reset();
    }

}
