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
            'provider' => 'newsline',
            'template' => 'templates.guest.newspage.main'
        ],
        'right_aside' => [
            //'provider' => 'newsline',
            //'count' => 4,
            //'sortby' => 'desc',
            //'hidelast' => 1,
            'template' => 'templates.empty',
        ],
    ],

];