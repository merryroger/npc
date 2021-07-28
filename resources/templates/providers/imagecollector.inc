<?php
/**
 * ImageCollector provider`s treat script
 * Created by: Merry Roger
 * Date: 23.07.2021
 */

$total = \App\Models\Image::total();
$contents = view($sets['template'], compact(['total']))->render();
