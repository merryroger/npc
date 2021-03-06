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

    public function load($src, ...$params)
    {
        $this->reference->loadLocations($src, $params);
    }

    public function getItem($recId): array
    {
        return $this->reference->getItem($recId);
    }

    public function addRecord($params, &$erc)
    {
        return $this->reference->addRecord($params, $erc);
    }

    public function updateRecord($extra_data, &$erc): bool
    {
        return $this->reference->updateRecord($extra_data, $erc);
    }

    public function deleteRecord($extra_data, $erc): bool
    {
        return $this->reference->deleteRecord($extra_data, $erc);
    }

    public function getVocabulary($topics)
    {
        return $this->reference->getVocabulary($topics);
    }

    public function getContents()
    {
        return $this->reference->getContents();
    }

}
