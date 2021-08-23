<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents\collections;

use ehwaz\interfaces\ExtendedDocumentProvider;

class ImageCollectionProvider implements ExtendedDocumentProvider
{

    private $collector;

    //private $parameters = ['base_dir' => '', 'page' => 1, 'xslt' => []];

    public function __construct(ImageCollector $imageCollector)
    {
        $this->collector = $imageCollector;
    }

    public function getFileUploadDir(): string
    {
        return $this->collector->getFileUploadDir();
    }

    public function storeUploadedFile($destFile, $pack_id = null): void
    {
        $this->collector->storeUploadedFile($destFile, $pack_id);
    }

    public function load($src, ...$params)
    {
        $this->collector->loadCollection($src, $params);
    }

    public function deleteItem($recId): bool
    {
        return $this->collector->deleteItem($recId);
    }

    public function getContents()
    {
        return $this->collector->getContents();
    }

}
