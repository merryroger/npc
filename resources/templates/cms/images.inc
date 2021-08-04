<?php
/**
 * Created by: Merry Roger
 * Date: 22.07.2021
 */

$this->config = [

    'blocks' => 1,
    'contents' => [
        'list' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images',
        ],
        'RIAF' => [
            'template' => 'templates.cms.collections.images.load_form'
        ],
        'CFUP' => [
            'provider' => 'imagecollector',
        ]
    ],

];
