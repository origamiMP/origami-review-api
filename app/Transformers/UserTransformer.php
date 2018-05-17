<?php namespace App\Transformers;

use App\Models\User;

class UserTransformer extends BaseTransformer
{
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
            'name' => $user->name,
            'email' => $user->email,
            'remember_token' => $user->getRememberToken(),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ]);
    }
}