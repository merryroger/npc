<?php
/**
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwas\documents\tyrion;


class TyrionReader extends TyrionDoc
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loadDocument($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
        parent::loadDocument($doc_path, $base_dir);

        $this->page = $page;
        $this->xslt = $xslt;

        $this->parseDocument();
        $this->loadPage();

    }

    public function getParameter($param): string
    {
        switch (strtolower($param)) {
            case 'contents':
            case 'docheader':
            case 'colontitule':
            case 'stamps': return $this->$param;
            default: return '';
        }

    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
