<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index()
    {
        return Product::all();
    }
    public function show(Product $product)
    {
        return $product;
    }

    public function showByCar(Car $car){

        return new ProductCollection($car->products);
    }

    public function showByWish(WishList $wishList){

        return new ProductCollection($wishList->products);
    }
    public function store (Request $request)
    {
        $product = Product::create($request->all());
        return  response()->json($product,201);
    }
    public function storeByCar (Car $car, $id)
    {
        $this->authorize('storeByCar', $car);
        if(!$car->products()->where('product_id',$id)->exists()){
            $car->products()->save(Product::find($id));
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return  response()->json(null,200);
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
