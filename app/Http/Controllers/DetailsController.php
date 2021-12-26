<?php

namespace App\Http\Controllers;

use App\Models\OrderBuy;
use Illuminate\Http\Request;
use App\Models\BuyDetail;
use App\Http\Resources\Detail as DetailResource;
use App\Http\Resources\DetailCollection;


class DetailsController extends Controller
{
    //
    public function index(OrderBuy $orderBuy)
    {
        return response()->json(new DetailCollection($orderBuy->details));

    }
    public function show(BuyDetail $buyDetail)
    {
        return response()->json(new DetailResource($buyDetail),200);
    }
//    public function show(BuyDetail $detailsBuy)
//    {
//        return response()->json(new DetailResource($detailsBuy),200);
//    }
    public function store (Request $request)
    {
        $detailBuy = BuyDetail::create($request->all());
        return  response()->json($detailBuy,201);
    }
    public function update(Request $request, BuyDetail $detailsBuy)
    {
        $detailsBuy->update($request->all());
        return response()->json($detailsBuy,200);
    }

    public function delete(BuyDetail $detailsBuy)
    {
        $detailsBuy->delete();
        return response()->json(null,204);
    }
}
