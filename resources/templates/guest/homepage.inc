<?php
/**
 * Created by: Merry Roger
 * Date: 01.07.2021
 */

$this->config = [

    'blocks' => 4,
    'contents' => [
        'left_aside' => [
            'template' => 'templates.empty',
        ],
        'main_sheet' => [
            //'provider' => 'tyrion',
            'provider' => 'rootpage',
            'textprovider' => 'tyrion',
            'videoprovider' => 'videos',
            'sources' => [
                'leadart' => 'documents/region/Preserving_the_history_of_the_native_land.xml',
                //'leadart' => 'documents/about.xml',
                'photos' => 'documents/collections/photos.xml',
                'videos' => 'documents/collections/videos.xml',
            ],
            'template' => 'templates.guest.homepage.main',
            'video_template' => 'templates.guest.homepage.video'
        ],
        'right_aside' => [
            'provider' => 'newsline',
            'textprovider' => 'tyrion',
            'count' => 4,
            'order' => 'desc',
            'hidelast' => 1,
            'template' => 'templates.guest.homepage.news',
            'haspreview' => 'templates.guest.homepage.haspreview',
            'nopreview' => 'templates.guest.homepage.nopreview'
        ],
        'banners' => [
            'template' => 'templates.guest.homepage.banners'
        ],
    ],

];
