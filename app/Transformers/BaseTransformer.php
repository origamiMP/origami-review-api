<?php namespace App\Transformers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param array $params
     * @return array
     */
    public function meta(array $params)
    {
        $params['meta'] = [
            'copyright' => 'Copyright 2018 Origami Review',
            'authors' => [
                'Antoine Dewaele',
                'Vincent Pichon',
                'Julien Bruitte'
            ]
        ];

        return $params;
    }
}