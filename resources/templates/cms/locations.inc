<?php
/**
 * Created by: Merry Roger
 * Date: 22.07.2021
 */

$this->config = [

    'blocks' => 1,
    'contents' => [
        'list' => [
            'provider' => 'resourcelocator',
            'template' => 'templates.cms.references.locations',
        ],
        'RAFM' => [
            'template' => 'templates.cms.references.locations.add_form',
        ],
        'IFRM' => [
            'provider' => 'resourcelocator',
        ],
        'IRRM' => [
            'provider' => 'resourcelocator',
        ],
        'RLAD' => [
            'provider' => 'resourcelocator',
        ],
    ],

];
