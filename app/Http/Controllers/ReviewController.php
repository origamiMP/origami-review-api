<?php

namespace App\Http\Controllers;

use App\Http\Rule;
use App\Models\Review;
use App\Transformers\ReviewTransformer;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $type = 'reviews';

    public function index()
    {
        return $this->collection(Review::all(), new ReviewTransformer());
    }

    public function show($id)
    {
        return $this->item(Review::find($id), new ReviewTransformer());
    }

    public function store(Request $request)
    {
        $this->validate($request, Rule::REVIEW_RULES);

        $params = $request->all();
        $review = Review::create($params);

        if ($params['certified'])
            $review->certify($params['wallet'], $params['review_hash'], $params['review_signed_hash']);

        return $this->item($review, new ReviewTransformer());
    }
}