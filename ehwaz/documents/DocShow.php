<?php
/**
 * Created by Ehwaz Raido.
 * Date: 02.07.2021
 */

namespace ehwas\documents;


class DocShow
{
    protected const REL_DIR = '/../../resources';

    protected $base_dir;
    protected $config;
    protected $contents;

    public function __construct()
    {
        $this->base_dir = realpath(__DIR__ . $this::REL_DIR);
        $this->config = null;
        $this->contents = [];

    }

    protected function loadConfig($conf_path = ''): void
    {
        if ($conf_path) {
            $config_path = $this->base_dir . '/' . join('/', preg_split("%\.%", $conf_path)) . '.inc';
        } else {
            $config_path = null;
            return;
        }

        if ($config_path && file_exists($config_path)) {
            include($config_path);
        }
    }

    protected function parseConfig(): void
    {
        if ($this->config == null || !isset($this->config['contents'])) {
            return;
        }

        foreach ($this->config['contents'] as $block => $settings) {
            $this->contents[$block] = $this->buildTemplate($settings);
        }
dd($this->contents);
    }

    protected function buildTemplate($sets): string
    {
        if (!isset($sets['provider'])) {
            return view($sets['template']);
        }
if ($sets['provider'] == 'newspreview') {
return 'temporary nothing';
}
        $provider = app($sets['provider']);

        return '';
    }

    public function &retrieveContents($conf_path = ''): array
    {
        $this->loadConfig($conf_path);
        $this->parseConfig();
        //   $this->render($page);

        return $this->contents;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

}
