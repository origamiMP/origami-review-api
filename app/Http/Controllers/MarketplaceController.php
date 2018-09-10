<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use App\Transformers\MarketplaceTransformer;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    protected $type = 'marketplaces';


    public function index(Request $request)
    {
        $marketplaces = Marketplace::all();
        if ($request->get('search'))
            $marketplaces = Marketplace::where('name', 'like', '%'.$request->get('search').'%')->get();

        return $this->collection($marketplaces, new MarketplaceTransformer());
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
            'name' => 'required|string|unique:marketplaces,name,'.$id,
            'wallet' => 'nullable|string|unique:marketplaces,wallet',
            'default_review_delay' => 'integer|min:0'
        ]);

        Marketplace::find($id)->update($request->all());

        return $this->noContent();
    }

    public function destroy($id)
    {
        Marketplace::find($id)->delete();

        return $this->noContent();
    }
}
