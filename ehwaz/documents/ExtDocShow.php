<?php
/**
 * Created by Ehwaz Raido.
 * Date: 23.07.2021
 */

namespace ehwas\documents;

class ExtDocShow extends DocShow
{

    protected const DEF_BLOCK_NAME = 'contents';
    protected const DEF_OUTPUT_NAME = 'contents';

    public function __construct()
    {
        parent::__construct();
    }

    protected function parseConfig($extra_data, $block_name = null, $out_name = null): void
    {
        if (!isset($block_name) && !isset($out_name)) {
            parent::parseConfig($extra_data);
            return;
        }

        if (!isset($block_name)) {
            $block_name = $this::DEF_BLOCK_NAME;
        }

        if (!isset($out_name)) {
            $out_name = $this::DEF_OUTPUT_NAME;
        }

        $this->contents[$out_name] = $this->buildTemplate($this->config['contents'][$block_name], $extra_data);
    }

    public function &retrieveContents($conf_path = '', $extra_data = [], $block_name = null, $out_name = null): array
    {
        $this->loadConfig($conf_path);
        $this->parseConfig($extra_data, $block_name, $out_name);

        return $this->contents;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}
