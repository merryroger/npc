<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;


use App\Models\Location;

class Collections
{
    protected $contents;

    public function __construct()
    {
    }

    protected function getReceptionDir(): string
    {
        return Location::LocationDirById(1);
    }

    public function getFileUploadDir(): string
    {
        $fupDir = public_path() . $this->getReceptionDir();

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

    public function __destruct()
    {
    }

}
