<?php

namespace App\Http\Controllers;

use App\Models\BuyDetail;
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
     //   $this->authorize('storeByCar', $car);
        if(!$car->products()->where('product_id',$id)->exists()){
            $car->products()->save(Product::find($id));
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return  response()->json('El producto ya se encuentra en el carrito',200);
    }

    public function storeByWish(WishList $wishList, $id)
    {
        if(!$wishList->products()->where('product_id', $id)->exists()){
            $wishList->products()->save(Product::find($id));
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return response()->json('El producto ya se encuentra agregado en la lista de deseos',200);
    }



    public function deleteByCar(Car $car, $id){
        if($car->products()->where('product_id', $id)->exists()){
            $car->products()->detach($id);
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return response()->json('Producto no existente',200);
    }


    public function deleteByWish(WishList $wishList, $id)
    {

      //  $this->authorize('deleteByWish' , $wishList);

//        $products = Product::all();
//
//        foreach ($products as $p){
//            if($p->id === $id){
        if($wishList->products()->where('product_id', $id)->exists()){
            $wishList->products()->detach($id);
            return response()->json(new ProductResource(Product::find($id)),200);
        }
//            }
//        }

        return response()->json('Producto no existente', 205);

    }

    public function clearCar(Car $car){
        if($car->products()->exists()){
            $car->products()->detach();
            return response()->json('Productos eliminados del carrito',200);
        }

        return response()->json('No se encuentran productos en el carrito', 200);
    }

    public function storeByDetail( BuyDetail $buyDetail, Car $car)
    {

        $productCar = $car->products;
        $products = [];

        foreach ($productCar as $p){
            $products[]= $p;
        }
        $buyDetail->products()->saveMany($products);

        return response()->json(new ProductCollection($products),200);

//        $buyDetails = [];
//        $buyDetails[]= Product::find(6);
//        $buyDetails[]= Product::find(7);
//
//        $buyDetail->products()->saveMany($buyDetails);
//
//        return response()->json(new ProductCollection($buyDetails),200);

//        if(!$buyDetail->products()->where('product_id', $id)->exists()){
//            $buyDetail->products()->save(Product::find($id));
//            return response()->json(new \Illuminate\Http\Resources\Json\JsonResource(Product::find($id)),200);
//        }

        //return response()->json('El producto ya se encuentra facturado',200);
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
