<?php

namespace App\Models;

use App\Uuids;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
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
 * @property-read \Illuminate\Database\Eloquent\Model|Eloquent $organization
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereOrganizationId($value)
 * @method static Builder|User whereOrganizationType($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use HasApiTokens, Authenticatable, Authorizable, Uuids;

    protected $rules = [
        'id' => 'string|unique:users,id,{id}',
        'email' => 'required|email|unique:users,email,{email}',
        'organization_id' => 'required|integer|min:0',
        'organization_type' => 'required|string|in:App\Models\Marketplace,App\Models\Seller',
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

    public static function create(array $attributes = [])
    {
        $organization = self::createOrganization($attributes);

        $attributes['organization_id'] = $organization->id;
        $attributes['organization_type'] = get_class($organization);

        \Log::info(get_class($organization));

        return parent::create($attributes);
    }

    public static function createOrganization(array $attributes)
    {
        if ($attributes['organization_type'] == 'seller')
            return Seller::create(['name' => $attributes['organization_name']]);
        else
            return Marketplace::create(['name' => $attributes['organization_name']]);
    }
}
