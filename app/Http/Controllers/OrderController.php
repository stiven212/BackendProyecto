<?php

namespace App\Http\Controllers;

use App\Models\BuyDetail;
use Illuminate\Http\Request;
use App\Models\OrderBuy;
use App\Http\Resources\Detail as DetailResource;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    //
    public function index()
    {
        return response()->json(new OrderCollection(OrderBuy::all()),200);
    }
    public function show(OrderBuy $orderBuy)
    {
        $this->authorize('view',$orderBuy);

        return response()->json(new OrderResource($orderBuy),200);
    }

    public function store (Request $request)
    {

        $orderBuy = OrderBuy::create($request->all());
        return  response()->json($orderBuy,201);
    }
    public function showDetail(OrderBuy $orderBuy, BuyDetail $buyDetail)
    {
        $this->authorize('showDetail', $orderBuy);
        $buyDetail = $orderBuy->details()->where('id', $buyDetail->id)->firstOrFail();

        return response()->json(new DetailResource($buyDetail),200);
    }

    public function update(Request $request, OrderBuy $orderBuy)
    {

        $this->authorize('update', $orderBuy);
        $orderBuy->update($request->all());
        return response()->json($orderBuy,200);
    }

    public function delete(OrderBuy $orderBuy)
    {
        $orderBuy->delete();
        return response()->json('Orden eliminado con exito',204);
    }
}
