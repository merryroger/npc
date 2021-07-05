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
    private $parameters = ['location' => '', 'code' => '', 'xslt' => []];

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
        $this->newsline->getNewsCount();
    }

    public function getContents()
    {
        return $this->newsline->getContents();
    }

}
