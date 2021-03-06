<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $organization_id
 * @property string $organization_type
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $organization
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static Builder|\App\Models\User whereCreatedAt($value)
 * @method static Builder|\App\Models\User whereEmail($value)
 * @method static Builder|\App\Models\User whereId($value)
 * @method static Builder|\App\Models\User whereOrganizationId($value)
 * @method static Builder|\App\Models\User whereOrganizationType($value)
 * @method static Builder|\App\Models\User wherePassword($value)
 * @method static Builder|\App\Models\User whereRememberToken($value)
 * @method static Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable;

    protected $rules = [
        'id' => 'integer|min:0|unique:users,id,{id}',
        'email' => 'required|string|unique:users,email,{email}',
        'organization_id' => 'required|integer|min:0',
        'organization_type' => 'required|string|in:\App\Models\Marketplace,\App\Models\Seller',
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
