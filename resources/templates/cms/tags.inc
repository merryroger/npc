<?php
/**
 * Created by: Merry Roger
 * Date: 25.01.2022
 */

$this->config = [

    'blocks' => 1,
    'contents' => [
        'list' => [
            'provider' => 'taglibrary',
            'template' => 'templates.cms.references.tags',
        ],
        'RAFM' => [
            'template' => 'templates.cms.references.tags.add_form'
        ],
        'REFM' => [
            'provider' => 'taglibrary',
            'template' => 'templates.cms.references.tags.edit_form'
        ],
        'RTUD' => [
            'provider' => 'taglibrary',
        ],
        'RTAD' => [
            'provider' => 'taglibrary',
            'template' => 'templates.cms.references.tags',
        ],
        'ITRM' => [
            'provider' => 'taglibrary',
            'template' => 'templates.cms.references.tags',
        ]
    ],

];
