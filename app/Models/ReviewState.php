<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * App\Models\ReviewState
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @method static Builder|ReviewState whereCreatedAt($value)
 * @method static Builder|ReviewState whereId($value)
 * @method static Builder|ReviewState whereName($value)
 * @method static Builder|ReviewState whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ReviewState extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:review_states,id,{id}',
        'name' => 'required|string'
    ];

    protected $fillable = [
        'name'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public static function getCreatedReviewState()
    {
        return self::getReviewState('CREATED');
    }

    public static function getAcceptedReviewState()
    {
        return self::getReviewState('ACCEPTED');
    }

    public static function getRefusedReviewState()
    {
        return self::getReviewState('REFUSED');
    }

    public static function getCertifiedReviewState()
    {
        return self::getReviewState('CERTIFIED');
    }

    private static function getReviewState(string $state)
    {
        $createdReviewState = self::whereName($state)->first();

        if (!$createdReviewState)
            throw new NotFoundHttpException($state . ' Review State not found');

        return $createdReviewState;
    }
}
