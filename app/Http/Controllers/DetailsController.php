<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Models\OrderBuy;
use Illuminate\Http\Request;
use App\Models\BuyDetail;
use App\Http\Resources\Detail as DetailResource;
use App\Http\Resources\DetailCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class DetailsController extends Controller
{
    //
    public function index(OrderBuy $orderBuy)
    {
        $this->authorize('viewAny', $orderBuy);
        return response()->json(new DetailCollection($orderBuy->details),200);

    }

    public function all()
    {

        $details = DB::table('buy_details')->orderBy('id', 'desc')->paginate(5);

        return response()->json($details,200);
    }
    public function show(BuyDetail $buyDetail)
    {
        return response()->json(new DetailResource($buyDetail),200);
    }
//    public function show(BuyDetail $detailsBuy)
//    {
//        return response()->json(new DetailResource($detailsBuy),200);
//    }
    public function store (Request $request, OrderBuy $orderBuy)
    {
        //$detailBuy = BuyDetail::create($request->all());
        $detailBuy = $orderBuy->details()->save(new BuyDetail($request->all()));
      //  Mail::to($orderBuy->user)->send(new NewOrder($detailBuy));
        return  response()->json(new DetailResource($detailBuy),201);
    }
    public function update(Request $request, BuyDetail $buyDetail)
    {
        $buyDetail->update($request->all());
        return response()->json(new DetailResource($buyDetail),200);
    }

    public function delete(BuyDetail $detailsBuy)
    {
        $detailsBuy->delete();
        return response()->json(null,204);
    }
}
