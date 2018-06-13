<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use App\Transformers\MarketplaceTransformer;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    protected $type = 'marketplaces';


    public function index()
    {
        return $this->collection(Marketplace::all(), new MarketplaceTransformer());
    }

    public function show($id)
    {
        return $this->item(Marketplace::find($id), new MarketplaceTransformer());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:marketplaces,name',
            'wallet' => 'required|string|unique:marketplaces,wallet',
            'default_review_delay' => 'required|integer|min:0'
        ]);

        $marketplace = Marketplace::create($request->all());

        return $this->item($marketplace, new MarketplaceTransformer(), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:marketplaces,name',
            'wallet' => 'required|string|unique:marketplaces,wallet',
            'default_review_delay' => 'required|integer|min:0'
        ]);

        Marketplace::find($id)->update($request->all());

        return response()->setStatusCode(204);
    }

    public function destroy($id)
    {
        Marketplace::find($id)->delete();

        return response()->setStatusCode(204);
    }
}
