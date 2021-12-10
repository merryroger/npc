<?php
/**
 * Created by: Merry Roger
 * Date: 10.12.2021
 */

    $docs = [];

    $defsrc = "documents/empty.xml";

    $bdr = addslashes($this->base_dir);
    $page = (isset($extra_data['page'])) ? intval($extra_data['page']) : 1;
    $textReader = app($sets['textprovider']);

    if (isset($sets['source'])) {
        $src = (file_exists($this->base_dir . '/' . $src)) ? $src : $defsrc;
        $xslt = (isset($sets['xslt'])) ? $sets['xslt'] : [];

        $textReader->load($src, $this->base_dir, $page, $xslt);

        $docs[$key] = $textReader->getContents();
    } elseif (isset($sets['sources']) && is_array($sets['sources'])) {
        foreach ($sets['sources'] as $key => $src) {
            $src = (file_exists($this->base_dir . '/' . $src)) ? $src : $defsrc;
            $xslt = (isset($sets['xslt']) && isset($sets['xslt'][$key])) ? $sets['xslt'][$key] : [];

            $textReader->load($src, $this->base_dir, $page, $xslt);

            $docs[$key] = $textReader->getContents();
        }
    }

    $videoBuilder = app($sets['videoprovider']);

    if ($videoBuilder->checkVideos()) {
        $video = $videoBuilder->getLatestVideo();
        if (isset($video['comment']) && $video['comment']) {
            $doc_path = preg_replace("%^{$bdr}%sU", '', $video['comment']);
            $textReader->load($doc_path, $this->base_dir, 1, $xslt);
            $video['comment'] = preg_replace("/[\\n\\r]/", '', strip_tags($textReader->getContents()));
        } else {
            $video['comment'] = '';
        }

        if ($video) {
            $docs['videos'] = view($sets['video_template'], compact('video'))->render();
        }
    }

    $contents = view($sets['template'], compact('docs'))->render();
