<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailsBuy;
use App\Http\Resources\Detail as DetailResource;


class DetailsController extends Controller
{
    //
    public function index()
    {
        return DetailsBuy::all();
    }
    public function show($id)
    {
        return response()->json(new DetailResource(DetailsBuy::find($id)),200);
    }
    public function store (Request $request)
    {
        $detailBuy = DetailsBuy::create($request->all());
        return  response()->json($detailBuy,201);
    }
    public function update(Request $request, DetailsBuy $detailsBuy)
    {
        $detailsBuy->update($request->all());
        return response()->json($detailsBuy,200);
    }

    public function delete(DetailsBuy $detailsBuy)
    {
        $detailsBuy->delete();
        return response()->json(null,204);
    }
}
