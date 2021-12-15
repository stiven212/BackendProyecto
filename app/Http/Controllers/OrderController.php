<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderBuy;

class OrderController extends Controller
{
    //
    public function index()
    {
        return OrderBuy::all();
    }
    public function show(OrderBuy $orderBuy)
    {
        return $orderBuy;
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
