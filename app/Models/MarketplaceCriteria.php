<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\MarketplaceCriteria
 *
 * @property int $id
 * @property string $name
 * @property float $weight
 * @property int $marketplace_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Marketplace $marketplace
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MarketplaceCriteriaRating[] $marketplace_criteria_ratings
 * @method static Builder|MarketplaceCriteria whereCreatedAt($value)
 * @method static Builder|MarketplaceCriteria whereId($value)
 * @method static Builder|MarketplaceCriteria whereMarketplaceId($value)
 * @method static Builder|MarketplaceCriteria whereName($value)
 * @method static Builder|MarketplaceCriteria whereUpdatedAt($value)
 * @method static Builder|MarketplaceCriteria whereWeight($value)
 * @mixin Eloquent
 */
class MarketplaceCriteria extends BaseModel
{
    protected $rules = [
        'id' => 'integer|min:0|unique:marketplace_criteria,id,{id}',
        'name' => 'required|string',
        'weight' => 'required|numeric',
        'marketplace_id' => 'required|integer|min:0|exists:marketplaces,id'
    ];

    protected $fillable = [
        'name', 'weight', 'marketplace_id'
    ];

    public $table = 'marketplace_criteria';

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }

    public function marketplace_criteria_ratings()
    {
        return $this->hasMany(MarketplaceCriteriaRating::class);
    }
}
