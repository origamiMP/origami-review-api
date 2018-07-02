<?php

return [

    'default_review_blockchain' => env('DEFAULT_REVIEW_BLOCKCHAIN', 'ipfs'),
    'default_node_blockchain' => env('DEFAULT_NODE_BLOCKCHAIN', 'ethereum'),


    'ipfs' => [
        'gateway' => '',
    ],

    'ethereum' => [
        'gateway' => '',
    ]
];
