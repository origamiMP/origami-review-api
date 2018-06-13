<?php

namespace App\Http\Controllers;

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
        $this->validate($request, [
            'wallet' => 'required|string',
            'text' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
            'order_id' => 'required|integer|exists:orders,id|unique:reviews,order_id',
        ]);

        $marketplace = Review::create($request->all());

        return $this->item($marketplace, new ReviewTransformer(), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'wallet' => 'required|string',
            'text' => 'required|string',
            'rating' => 'required|integer|min:0|max:5',
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        Review::find($id)->update($request->all());

        return response()->setStatusCode(204);
    }

    public function destroy($id)
    {
        Review::find($id)->delete();

        return response()->setStatusCode(204);
    }
}
