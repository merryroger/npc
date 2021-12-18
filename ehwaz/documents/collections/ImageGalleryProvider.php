<?php
/**
 * Created by Ehwaz Raido.
 * Date: 18.12.2021
 */

namespace ehwas\documents\collections;

use ehwaz\interfaces\DocumentProvider;

class ImageGalleryProvider implements DocumentProvider
{

    private $imageGallery;
    private $parameters = [
        'xslt' => []
    ];

    public function __construct(ImageGalleryCollector $imageGalleryCollector)
    {
        $this->imageGallery = $imageGalleryCollector;
    }

    public function load($src, ...$params)
    {
        $param_keys = array_keys($this->parameters);

        if ($params) {
            foreach ($params as $pid => $value) {
                $this->parameters[$param_keys[$pid]] = $value;
            }
        }
    }

    public function checkGalleriesCount() {
        return $this->imageGallery->getPhotoGalleriesCount();
    }

    public function getContents()
    {
        return $this->imageGallery->getContents();
    }
}
