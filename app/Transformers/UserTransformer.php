<?php namespace App\Transformers;

use App\Models\User;

class UserTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'author'
    ];

    /**
     * Turn this item object into a generic array
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return parent::meta([
            'id' => $user->id,
            'email' => $user->email,
            'remember_token' => $user->getRememberToken(),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]);
    }

    public function includeOrganization(User $user)
    {
        $class = substr($user->organization_type, strrpos($user->organization_type, '/') + 1);
        $transformer = "\\App\\Transformers\\" . $class . "Transformer";

        return $this->item($user->organization, new $transformer());
    }

}