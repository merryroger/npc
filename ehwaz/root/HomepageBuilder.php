<?php
/**
 * Created by Ehwaz Raido.
 * Date: 10.12.2021
 */

namespace ehwas\root;

class HomepageBuilder
{
    protected const HANDLERS_DIR = '/templates/providers';

    protected $base_dir;
    protected $textProvider;

    public function __construct()
    {
        $this->textProvider = null;
    }

    public function load($doc_path = '', $base_dir = __DIR__, $page = 1, $xslt = []): void
    {
        $this->base_dir = $base_dir;
    }

    public function loadTextModules($provider_type, $extra_data, $sets)
    {
        $docs = [];
        $this->textProvider = $provider = app($provider_type);

        if (file_exists($this->base_dir . $this::HANDLERS_DIR . '/' . $sets['textprovider'] . '.inc')) {
            include($this->base_dir . $this::HANDLERS_DIR . '/' . $sets['textprovider'] . '.inc');
        }

        return $docs;
    }

    public function getTextProvider()
    {
        return $this->textProvider;
    }

    public function getContents()
    {
        return '';
    }

    public function __destruct()
    {
    }

}
