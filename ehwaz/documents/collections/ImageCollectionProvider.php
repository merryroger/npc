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

    public function storePreview($destFile, $recId): void
    {
        $this->collector->storePreview($destFile, $recId);
    }

    public function load($src, ...$params)
    {
        $this->collector->loadCollection($src, $params);
    }

    public function getItem($recId): array
    {
        return $this->collector->getItem($recId);
    }

    public function deleteItem($recId): bool
    {
        return $this->collector->deleteItem($recId);
    }

    public function deletePreview($recId): bool
    {
        return $this->collector->deletePreview($recId);
    }

    public function imageRelocate($currentImageData, $requestedData, &$erc): bool
    {
        return $this->collector->imageRelocate($currentImageData, $requestedData,$erc);
    }

    public function getContents()
    {
        return $this->collector->getContents();
    }

    public function getLocations($show_hidden = true): array
    {
        return $this->collector->getLocations($show_hidden);
    }

}
