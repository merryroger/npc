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

    const VIDEOS_ORIGIN = '/../resources/documents/video';

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

    public function loadPageList($page, &$sets)
    {
        $video_data_path = realpath(app_path() . '/' . $this::VIDEOS_ORIGIN);

        return Video::pageList($page, $sets)->get()->map(function ($item) use ($video_data_path) {
            if (isset($item->comment)) {
                $item->comment = realpath($video_data_path . '/' . $item->comment);
            }

            return collect($item)->except(['hidden', 'created_at', 'updated_at', 'deleted_at'])->all();
        })->all();
    }

    public function getContents()
    {
        return '';
    }

    public function __destruct()
    {
    }

}
