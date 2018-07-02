<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Transformers\ReviewTransformer;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $type = 'reviews';

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int $id
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($id)
    {
//        $client = new Client();
//        $response = $client->request('GET', 'ipfs:5001/api/v0/cat?arg=/ipfs/Qma1msvvP63xDoVrwpudyHo9HFxUVv5taBgvUvPnfT7jeD/cat.jpg');
//        dd('ok');
//
//        dd($response);
//        return $this->item(User::find($id), new UserTransformer());
        return;
    }

    public function store(Request $request)
    {
    }
}
