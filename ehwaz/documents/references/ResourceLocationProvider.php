<?php
/**
 * Created by Ehwaz Raido.
 * Date: 06.10.2021
 */

namespace ehwas\documents\references;

use ehwaz\interfaces\ExtendedDocumentProvider;

class ResourceLocationProvider implements ExtendedDocumentProvider
{

    private $reference;

    public function __construct(ResourceLocatior $resourceLocatior)
    {
        $this->reference = $resourceLocatior;
    }
/*
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
*/
    public function load($src, ...$params)
    {
        $this->reference->loadLocations($src, $params);
    }
/*
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
*/
    public function getContents()
    {
        return $this->reference->getContents();
    }

}
