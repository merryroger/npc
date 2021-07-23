<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


class Collections
{

//    use \ehwaz\traits\XMLParsers;
//    use \ehwaz\traits\Transcoders;
//    use \ehwaz\traits\Evaluators;

//    const ERR_FILE_NOT_FOUND = 0xed01;
//    const ERR_FILE_EMPTY_OR_CORRUPTED = 0xed02;

    protected $contents;
//    protected $parameters;
//    protected $buffer;
//    protected $error;

//    protected $page;

    public function __construct()
    {
    }
/*
    public function loadDocument($doc_path = '', $base_dir = __DIR__): void
    {
        $this->reset();

        if (!$this->loadDocumentContents($base_dir . "/{$doc_path}")) {
            return;
        }

    }
*/
    public function getContents(): string
    {
        return $this->contents;
    }
/*
    protected function reset(): void
    {
    }
*/
    public function __destruct()
    {
//        $this->reset();
    }

}
