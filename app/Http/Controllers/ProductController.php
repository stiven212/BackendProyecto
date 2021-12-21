<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function index()
    {
        return new ProductCollection(Product::paginate(18)) ;
    }
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product),200);
    }
    public function store (Request $request)
    {
        $product = Product::create($request->all());
        return  response()->json($product,201);
    }
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product,200);

    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json(null,204);
    }
}
