<?php

namespace App\Models;

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
