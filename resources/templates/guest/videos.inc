<?php
/**
 * Created by: Merry Roger
 * Date: 01.07.2021
 */


$this->config = [

    'blocks' => 3,
    'contents' => [
        'main_sheet' => [
            'provider' => 'videos',
            'textprovider' => 'tyrion',
            'movesPerPage' => 12,
            'order' => 'desc',
            'template' => 'templates.guest.videos.main',
            'preview_template' => 'templates.guest.videos.preview',
            'preview_empty' => 'templates.guest.videos.preview_empty',
        ],
        'left_aside' => [
            'template' => 'templates.empty',
        ],
        'right_aside' => [
            'template' => 'templates.empty',
        ],
    ],

];
