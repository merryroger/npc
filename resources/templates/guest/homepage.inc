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
            'provider' => 'tyrion',
            'sources' => [
                'doc1' => 'documents/about.xml',
                'doc2' => 'documents/collections/photos.xml',
                'doc3' => 'documents/collections/videos.xml',
            ],
            'template' => 'templates.guest.homepage.main'
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
