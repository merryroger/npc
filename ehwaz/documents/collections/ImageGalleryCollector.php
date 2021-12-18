<?php
/**
 * Created by Ehwaz Raido.
 * Date: 18.12.2021
 */

namespace ehwas\documents\collections;

//use App\Models\Image;

class ImageGalleryCollector
{

    const PHOTOGALLERY_PREVIEW_ORDER = 'desc';

    public function __construct()
    {
    }

    public function load($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
    }

    public function getPhotoGalleriesCount()
    {
        return 0; /*********************  Temporary data *****************************/
    }

    public function getContents()
    {
        return '';
    }

    public function __destruct()
    {
    }

}
