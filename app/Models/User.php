<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    protected $rules = [
        'id' => 'integer|min:0|unique:users,id,{id}',
        'email' => 'required|string|unique:users,email,{email}',
        'organization_id' => 'required|integer|min:0',
        'organization_type' => 'required|string|in:marketplaces,sellers',
        'remember_token' => 'nullable|string',
    ];

    protected $fillable = [
        'name', 'email', 'organization_id', 'organization_type', 'remember_token'
    ];

    protected $hidden = [
        'password',
    ];

    public function organization()
    {
        return $this->morphTo();
    }
}
