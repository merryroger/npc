<?php
/**
 * Created by Ehwaz Raido.
 * Date: 05.07.2021
 */

namespace ehwas\news;

use ehwaz\interfaces\DocumentProvider;

class NewslineProvider implements DocumentProvider
{

    private $newsline;
    private $parameters = [
        'source' => '',
        'preview' => null,
        'official_news_date' => '2000-01-01 00:00:00',
        'collection_id' => 0,
        'xslt' => []
    ];

    public function __construct(NewslineReader $newslineReader)
    {
        $this->newsline = $newslineReader;
    }

    public function load($src, ...$params)
    {
        $param_keys = array_keys($this->parameters);

        if ($params) {
            foreach ($params as $pid => $value) {
                $this->parameters[$param_keys[$pid]] = $value;
            }
        }

        //$this->newsline->load($src, $this->parameters['base_dir'], $this->parameters['page'], $this->parameters['xslt']);
    }

    public function checkNews()
    {
        return $this->newsline->getNewsCount();
    }

    public function pickPreviewList(&$settings)
    {
        return $this->newsline->pickPreviewList($settings);
    }

    public function getLastNewsId()
    {
        return $this->newsline->getLastNewsId();
    }

    public function pickPreviewSurroundList($newsId, &$settings, &$info)
    {
        return $this->newsline->pickPreviewSurroundList($newsId, $settings, $info);
    }

    public function getItem($newsId, $show_hidden = false)
    {
        return $this->newsline->getItem($newsId, $show_hidden);
    }

    public function getContents()
    {
        return $this->newsline->getContents();
    }

}
