<?php
/**
 * Created by Ehwaz Raido.
 * Date: 06.12.2021
 */

namespace ehwas\videos;

use ehwaz\interfaces\DocumentProvider;

class VideosProvider implements DocumentProvider
{

    private $videos;
    private $parameters = [
        'source' => '',
        'preview' => null,
        'official_video_date' => '2000-01-01 00:00:00',
        'xslt' => []
    ];

    public function __construct(VideoPageCollector $videoPageCollector)
    {
        $this->videos = $videoPageCollector;
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

    public function checkVideos()
    {
        return $this->videos->getVideoRecordsCount();
    }

    public function getContents()
    {
        return $this->videos->getContents();
    }

}
