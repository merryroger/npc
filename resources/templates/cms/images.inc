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
        'EDIM' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images.edit_form'
        ],
        'CFUP' => [
            'provider' => 'imagecollector',
        ],
        'CFLD' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images',
        ],
        'CRLD' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images.dataset',
        ],
        'TITM' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images',
        ],
        'RITM' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images.dataset',
        ],
        'PWAF' => [
            'provider' => 'imagecollector',
            'template' => 'templates.cms.collections.images.preview_load_form'

        ]
    ],

];
