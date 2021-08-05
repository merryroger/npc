<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


class Collections
{
    protected const FILE_UPLOAD_RECEPTION_DIR = '/../storage/reception';
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

    public function getFileUploadDir()
    {
        $fupDir = public_path() . $this::FILE_UPLOAD_RECEPTION_DIR;
        if (!is_dir($fupDir)) {
            mkdir($fupDir);
        }

        return realpath($fupDir);
    }


    public function loadCollection($params, $extra): void
    {
    }

    public function getContents()
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
