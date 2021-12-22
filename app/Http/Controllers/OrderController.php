<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderBuy;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    //
    public function index()
    {
        return new OrderCollection( OrderBuy::paginate(10));
    }
    public function show(OrderBuy $orderBuy)
    {
        return response()->json(new OrderResource($orderBuy),200);
    }
    public function store (Request $request)
    {
        $orderBuy = OrderBuy::create($request->all());
        return  response()->json($orderBuy,201);
    }
    public function update(Request $request, OrderBuy $orderBuy)
    {
        $orderBuy->update($request->all());
        return response()->json($orderBuy,200);
    }

    public function delete(OrderBuy $orderBuy)
    {
        $orderBuy->delete();
        return response()->json(null,204);
    }
}
