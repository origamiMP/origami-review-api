<?php

namespace App\Http\Controllers;

use App\Http\Rule;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $type = 'users';

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int $id
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($id)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, Rule::USER_NEW_RULES);

        return $this->item(User::create($request->all()), new UserTransformer());
    }
}
