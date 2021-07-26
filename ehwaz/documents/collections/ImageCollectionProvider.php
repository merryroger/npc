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

    public function load($src, ...$params)
    {

    }

    public function getContents()
    {
        return $this->collector->getContents();
    }

}
