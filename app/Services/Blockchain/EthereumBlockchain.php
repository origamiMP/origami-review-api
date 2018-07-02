<?php

namespace App\Services\Blockchain;

use App\Models\Review;

class EthereumBlockchain extends BlockchainContract
{
    public function certifyReviewNodeId(Review $review)
    {
        //todo: save ddb_node_id in ethereum blockchain and get block_id & tx_id
        $review->blockchain_block_id = null;
        $review->blockchain_tx_id = null;
        $review->blockchain_supplier = "ethereum";
        $review->save();
    }
}