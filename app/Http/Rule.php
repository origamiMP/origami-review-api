<?php

namespace App\Http;

class Rule
{
    public const REVIEW_RULES = [
        'certified' => 'required|boolean',
        'text' => 'required|string',
        'criteria' => 'required|array',
        'criteria.*.marketplace_criteria_id' => 'required|integer|exists:marketplace_criteria,id',
        'criteria.*.rating' => 'required|integer|min:0|max:5',
        'wallet' => 'required_if:certified,true|string',
        'hash' => 'required_if:certified,true|string',
        'signed_hash' => 'required_if:certified,true|string',
//        'rating_without_criteria' => 'required_without:criteria|integer|min:0|max:5',
        'order_id' => 'required|string|exists:orders,id|unique:reviews,order_id',
    ];

    public const REVIEW_REFUSE_RULES = [
        'text' => 'required|string'
    ];

    public const REVIEW_COMMENT_RULES = [
        'text' => 'required|string'
    ];

    public const USER_NEW_RULES = [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        'organization_type' => 'required|string|in:seller,marketplace',
        'organization_name' => 'required|string',
        'cgv' => 'required|boolean'
    ];
}