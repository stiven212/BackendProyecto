<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailsBuy;

class DetailsController extends Controller
{
    //
    public function index()
    {
        return DetailsBuy::all();
    }
    public function show(DetailsBuy $detailsBuy)
    {
        return $detailsBuy;
    }
}
