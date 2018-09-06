<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Transformers\OrderTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $type = 'orders';


    public function index()
    {
        return $this->collection(Order::all(), new OrderTransformer());
    }

    public function show($id)
    {
        return $this->item(Order::find($id), new OrderTransformer());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'reference' => 'required|string',
            'review_delay' => 'nullable|integer|min:0',
            'date' => 'required|date',
        ]);

        $marketplace = Order::create($request->all());

        return $this->item($marketplace, new OrderTransformer(), 201);
    }

    public function demoSimulate(Request $request)
    {
        $this->validate($request, [
            'marketplace_id' => 'required|string|min:0',
            'seller_id' => 'required|string|min:0',
        ]);

        $order = Order::create([
            'reference' => uniqid(),
            'date' => Carbon::now(),
            'marketplace_id' => $request->get('marketplace_id'),
            'seller_id' => $request->get('seller_id'),
            'customer_id' => Customer::all()->first()->id
        ]);

        return $this->item($order, new OrderTransformer(), 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'reference' => 'required|string',
            'review_delay' => 'nullable|integer|min:0',
            'date' => 'required|date',
        ]);

        Order::find($id)->update($request->all());

        return response()->setStatusCode(204);
    }

    public function destroy($id)
    {
        Order::find($id)->delete();

        return response()->setStatusCode(204);
    }
}
