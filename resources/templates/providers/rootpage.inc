<?php
/**
 * Created by: Merry Roger
 * Date: 10.12.2021
 */

    $bdr = addslashes($this->base_dir);
    $provider->load('', $this->base_dir);
    $docs = $provider->loadTextModules($sets['textprovider'], $extra_data, $sets);

    $videoBuilder = app($sets['videoprovider']);

    // Temporarily checking of the videos has been blocked
    // till the problem the Youtube substitution is solved
    if (!$videoBuilder->checkVideos()) /* ($videoBuilder->checkVideos()) */ {
        $video = $videoBuilder->getLatestVideo();
        if (isset($video['comment']) && $video['comment']) {
            $doc_path = preg_replace("%^{$bdr}%sU", '', $video['comment']);
            $textReader = $provider->getTextProvider();
            $textReader->load($doc_path, $this->base_dir, 1, []);
            $video['comment'] = preg_replace("/[\\n\\r]/", '', strip_tags($textReader->getContents()));
        } else {
            $video['comment'] = '';
        }

        if ($video) {
            $docs['videos'] = view($sets['video_template'], compact('video'))->render();
        }
    }

    $contents = view($sets['template'], compact('docs'))->render();
