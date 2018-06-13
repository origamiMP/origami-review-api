<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
//        $client = new Client();
//        $response = $client->request('GET', 'ipfs:5001/api/v0/cat?arg=/ipfs/Qma1msvvP63xDoVrwpudyHo9HFxUVv5taBgvUvPnfT7jeD/cat.jpg');
//        dd('ok');
//
//        dd($response);
        return $this->item(User::find($id), new UserTransformer());
    }

    public function store(Request $request)
    {
        $client = new Client();
        $params = $request->all();
        $params['review'] = json_decode($params['data']);
        unset($params['data']);
        $params['timestamp'] = Carbon::now();

        $response = $client->request('GET', 'ipfs:5001/api/v0/add', [
            'multipart' => [
                [
                    'name' => 'test.json',
                    'contents' => json_encode($params),
                    'headers' => [
                        'Content-Type' => 'text/plain',
                        'Content-Disposition' => 'form-data; name="FileContents"; filename="test.json"',
                    ]
                ]
            ]
        ]);
        $hash = json_decode($response->getBody()->getContents())->Hash;

//        dd(json_decode($response->getBody()->getContents()));

        return response()->json(['response' => $hash]);
    }
}
