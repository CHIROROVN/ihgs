<?php

return [
    'parent'=> 'belong_parent_id',
    'primary_key' => 'belong_id',
    'generate_url'   => true,
    'childNode' => 'child',
    'body' => [
        'belong_id',
        'belong_name',
    ],

    'dropdown' => [
        'prefix' => '',
        'label' => 'belong_name',
        'value' => 'belong_id'
    ]
];
