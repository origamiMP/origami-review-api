<?php namespace App\Transformers;

use App\Models\ReviewComment;

class ReviewCommentTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'review', 'author'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param ReviewComment $reviewComment
     * @return array
     */
    public function transform(ReviewComment $reviewComment)
    {
        return parent::meta([
            'id' => $reviewComment->id,
            'text' => $reviewComment->text,
            'created_at' => $reviewComment->created_at,
            'updated_at' => $reviewComment->updated_at
        ]);
    }

    public function includeReview(ReviewComment $reviewComment)
    {
        return $this->item($reviewComment->review, new ReviewTransformer());
    }

    public function includeAuthor(ReviewComment $reviewComment)
    {
        $class = substr($reviewComment->author_type, strrpos($reviewComment->author_type, '/') + 1);
        $transformer = "\\App\\Transformers\\".$class."Transformer";

        return $this->item($reviewComment->author, new $transformer());
    }

}