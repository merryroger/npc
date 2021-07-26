<?php
/**
 * Created by: Merry Roger
 * Date: 23.07.2021
 */

$total = \App\Models\Image::total();
/*
    $docs = [];
    $xslt = [];

    $defsrc = "documents/empty.xml";

    $page = (isset($extra_data['page'])) ? intval($extra_data['page']) : 1;

    if (isset($sets['source'])) {
        $src = (file_exists($this->base_dir . '/' . $src)) ? $src : $defsrc;
        $xslt = (isset($sets['xslt'])) ? $sets['xslt'] : [];

        $provider->load($src, $this->base_dir, $page, $xslt);

        $docs[$key] = $provider->getContents();
    } elseif (isset($sets['sources']) && is_array($sets['sources'])) {
        foreach ($sets['sources'] as $key => $src) {
            $src = (file_exists($this->base_dir . '/' . $src)) ? $src : $defsrc;
            $xslt = (isset($sets['xslt']) && isset($sets['xslt'][$key])) ? $sets['xslt'][$key] : [];

            $provider->load($src, $this->base_dir, $page, $xslt);

            $docs[$key] = $provider->getContents();
        }
    }
*/
    $contents = view($sets['template'], compact(['total']))->render();

