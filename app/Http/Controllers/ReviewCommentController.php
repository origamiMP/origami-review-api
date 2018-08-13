<?php

namespace App\Http\Controllers;

use App\Http\Rule;
use App\Models\Review;
use App\Transformers\ReviewCommentTransformer;
use App\Transformers\ReviewTransformer;
use Illuminate\Http\Request;

class ReviewCommentController extends Controller
{
    protected $type = 'review_comments';

    public function store($id, Request $request)
    {
        $this->validate($request, Rule::REVIEW_COMMENT_RULES);

        $comment = Review::find($id)->addComment($request->get('text'), $request->ip());
        return $this->item($comment, new ReviewCommentTransformer());
    }

    public function accept($id)
    {
        Review::find($id)->accept();
        return $this->noContent();
    }

    public function refuse($id, Request $request)
    {
        $this->validate($request, Rule::REVIEW_REFUSE_RULES);

        Review::find($id)->refuse($request->get('text'), $request->ip());
        return $this->noContent();
    }

}