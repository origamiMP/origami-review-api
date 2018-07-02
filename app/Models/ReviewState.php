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
        $createdReviewState = self::whereName('CREATED')->first();

        if (!$createdReviewState)
            throw new NotFoundHttpException('Created Review State not found');

        return $createdReviewState;
    }
}
