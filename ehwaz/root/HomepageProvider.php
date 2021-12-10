<?php
/**
 * Created by Ehwaz Raido.
 * Date: 10.12.2021
 */

namespace ehwas\root;

use ehwaz\interfaces\DocumentProvider;

class HomepageProvider implements DocumentProvider
{

    private $homepage;
    private $parameters = [
        'xslt' => []
    ];

    public function __construct(HomepageBuilder $homepageBuilder)
    {
        $this->homepage = $homepageBuilder;
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

    public function getContents()
    {
        return $this->homepage->getContents();
    }

}
