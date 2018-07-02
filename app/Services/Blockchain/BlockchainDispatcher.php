<?php

namespace App\Services\Blockchain;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class BlockchainDispatcher implements ShouldQueue
{
    use Queueable;

    public const CERTIFY_REVIEW = 'certifyReview';
    public const CERTIFY_REVIEW_NODE_ID = 'certifyReviewNodeId';

    protected $method;
    protected $params;

    public function __construct($method, ...$params)
    {
        $this->method = $method;
        $this->params = $params;
    }

    public function handle()
    {
        $method = $this->method;

        $blockchain = ($method == self::CERTIFY_REVIEW) ?
            config('blockchains.default_review_blockchain') :
            config('blockchains.default_node_blockchain');

        App::make(config('blockchains.' . $blockchain . '.gateway'))->$method(...$this->params);
    }
}