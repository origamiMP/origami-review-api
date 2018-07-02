<?php

return [

    'default_review_blockchain' => env('DEFAULT_REVIEW_BLOCKCHAIN', 'ipfs'),
    'default_node_blockchain' => env('DEFAULT_NODE_BLOCKCHAIN', 'ethereum'),


    'ipfs' => [
        'gateway' => 'App\Services\Blockchain\IpfsBlockchain',
    ],

    'ethereum' => [
        'gateway' => 'App\Services\Blockchain\EthereumBlockchain',
    ]
];
