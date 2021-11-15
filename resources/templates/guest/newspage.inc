<?php
/**
 * Created by: Merry Roger
 * Date: 01.07.2021
 */


$this->config = [

    'blocks' => 4,
    'contents' => [
        'main_sheet' => [
            'provider' => 'newsmessage',
            'textprovider' => 'tyrion',
            'template' => 'templates.guest.newspage.main'
        ],
        'left_aside' => [
            'template' => 'templates.empty',
        ],
        'newslist' => [
            'provider' => 'newslist',
            //'count' => 3,
            //'sortby' => 'desc',
            'template' => 'templates.guest.newspage.list'
        ],
        'right_aside' => [
            'template' => 'templates.empty',
        ],
    ],

];
