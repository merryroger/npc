<?php
/**
 * Created by: Merry Roger
 * Date: 01.07.2021
 */

$this->config = [

    'blocks' => 3,
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
            'provider' => 'newspreview',
            'count' => 4,
            'sortby' => 'desc',
            'hidelast' => 1,
            'template' => 'templates.guest.homepage.news'
        ],
    ],

];
