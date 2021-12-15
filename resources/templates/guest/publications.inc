<?php
/**
 * Created by: Merry Roger
 * Date: 15.12.2021
 */


$this->config = [

    'blocks' => 4,
    'contents' => [
        'main_sheet' => [
            'provider' => 'tyrion',
            'source' => 'documents/subpages/publications.xml',
            'template' => 'templates.guest.subpage.main'
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
