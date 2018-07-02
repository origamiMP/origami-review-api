<?php

namespace App\Http;

class Rule
{
    public const REVIEW_RULES = [
        'certified' => 'boolean',
        'text' => 'required|string',
        'criteria' => 'array|present',
        'criteria.*.id' => 'required|integer|exists:marketplace_criteria,id',
        'criteria.*.rating' => 'required|integer|min:0|max:5',
        'wallet' => 'required_if:certified,true|string',
        'review_hash' => 'required_if:certified,true|string',
        'review_signed_hash' => 'required_if:certified,true|string',
        'rating_without_criteria' => 'required|integer|min:0|max:5',
        'order_id' => 'required|integer|exists:orders,id|unique:reviews,order_id',
    ];
}