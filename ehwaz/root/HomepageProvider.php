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
        $this->homepage->load($src, $params[0]);
    }

    public function loadTextModules($provider_type, &$extra_data, &$sets)
    {
        return $this->homepage->loadTextModules($provider_type, $extra_data, $sets);
    }

    public function getTextProvider()
    {
        return $this->homepage->getTextProvider();
    }

    public function getContents()
    {
        return $this->homepage->getContents();
    }

}
