<?php
/**
 * Created by: Merry Roger
 * Date: 14.12.2021
 */


$this->config = [

    'blocks' => 4,
    'contents' => [
        'main_sheet' => [
            'provider' => 'photogallery',
            'order' => 'desc',
            'template' => 'templates.guest.photos.main',
        ],
        'left_aside' => [
            'template' => 'templates.empty',
        ],
        'right_aside' => [
            'template' => 'templates.empty',
        ],
        'banners' => [
            'template' => 'templates.empty',
        ],
    ],

];
