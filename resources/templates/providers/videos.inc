<?php
/**
 * Created by: Merry Roger
 * Date: 06.12.2021
 */

    $xslt = '';

    $capacity = $provider->checkVideos();

    if ($capacity > 0) {

    }

    $contents = view($sets['template'], compact(['capacity']))->render();
