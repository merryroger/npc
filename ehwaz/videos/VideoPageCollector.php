<?php
/**
 * Created by Ehwaz Raido.
 * Date: 06.12.2021
 */

namespace ehwas\videos;

use App\Models\Video;

class VideoPageCollector
{

    const VIDEOSET_PREVIEW_ORDER = 'desc';

    //const NEWS_ORIGIN = '/../resources/documents/news';

    public function __construct()
    {
    }

    public function load($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
    }

    public function getVideoRecordsCount()
    {
        return Video::videosCount();
    }

    public function getContents()
    {
        return '';
    }

    public function __destruct()
    {
    }

}
