<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Transformers\SellerTransformer;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    protected $type = 'sellers';


    public function index(Request $request)
    {
        $sellers = Seller::all();
        if ($request->get('search'))
            $sellers = Seller::where('name', 'like', '%'.$request->get('search').'%')->get();
        return $this->collection($sellers, new SellerTransformer());
    }

    public function show($id)
    {
        return $this->item(Seller::find($id), new SellerTransformer());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:sellers,name',
        ]);

        $marketplace = Seller::create($request->all());

        return $this->item($marketplace, new SellerTransformer(), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:sellers,name',
        ]);

        Seller::find($id)->update($request->all());

        return response()->setStatusCode(204);
    }

    public function destroy($id)
    {
        Seller::find($id)->delete();

        return response()->setStatusCode(204);
    }
}
