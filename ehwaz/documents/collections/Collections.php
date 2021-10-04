<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


class Collections
{
    protected const FILE_UPLOAD_BASE_DIR = '/../storage';
    protected const FILE_UPLOAD_RECEPTION_DIR = '/../storage/reception';

    protected $contents;

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

    public function deleteItem($recId): bool
    {
    }

    public function deletePreview($recId): bool
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
