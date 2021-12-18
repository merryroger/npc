<?php
/**
 * Created by: Merry Roger
 * Date: 18.12.2021
 */

    $xslt = '';
    //$videos = [];
    //$bdr = addslashes($this->base_dir);
    //$message = trans('flasherrors.video.nocomment');

    $capacity = $provider->checkGalleriesCount();

    if ($capacity > 0) {
    }

    $contents = view($sets['template'], compact(['capacity']))->render();
