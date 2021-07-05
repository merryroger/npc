<?php
/**
 * Created by: Merry Roger
 * Date: 05.07.2021
 */

    $xslt = '';

    $capacity = $provider->checkNews();

    $contents = view($sets['template'], compact(['capacity']))->render();
