<?php

namespace App\Services\Blockchain;

use App\Models\Review;
use App\Models\ReviewState;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class IpfsBlockchain extends BlockchainContract
{
    public function certifyReview(Review $review)
    {
        \Log::info('certifyReview');
        $this->sendReviewRequest($review, [
            'review' => [
                'rating' => $review->rating,
                'comment' => $review->text,
                'timestamp' => $review->created_at
            ],
            'wallet' => $review->wallet,
            'hash' => $review->hash,
            'signed_hash' => $review->signed_hash
        ]);

        return true;
    }

    private function sendReviewRequest(Review $review, array $content)
    {
        try {

            $client = new Client();
            $response = $client->request('GET', 'ipfs:5001/api/v0/add', [
                'multipart' => [
                    [
                        'name' => 'OrigamiReview'.$review->id.'.json',
                        'contents' => json_encode($content),
                        'headers' => [
                            'Content-Type' => 'text/plain',
                            'Content-Disposition' => 'form-data; name="FileContents"; filename="OrigamiReview'.$review->id.'.json"',
                        ]
                    ]
                ]
            ]);

            $hash = json_decode($response->getBody()->getContents())->Hash;
            $review->ddb_node_id = $hash;
            $review->ddb_supplier = 'ipfs';
            $review->review_state_id = ReviewState::getCertifiedReviewState()->id;

            $review->save();

        } catch(GuzzleException $e) {
            //todo: see what to do if request failed
        }
    }
}