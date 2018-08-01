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
        return $this->collection(currentUser()->organization->reviews, new ReviewTransformer());
    }

    public function show($id)
    {
        return $this->item(Review::find($id), new ReviewTransformer());
    }

    public function store(Request $request)
    {
        $this->validate($request, Rule::REVIEW_RULES);

        return $this->item(Review::create($request->all()), new ReviewTransformer());
    }

    public function accept($id)
    {
        Review::find($id)->accept();
        return $this->noContent();
    }

    public function refuse($id)
    {
        Review::find($id)->refuse();
        return $this->noContent();
    }

}