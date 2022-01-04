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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

//    private static $rules =[
//        'name' => 'required|string|max:255',
//        'description' => 'required',
//        'color' => 'required',
//        'price' => 'required',
//        'sale' => 'required',
//        'category_id' => 'required|exists:categories,id'
//    ];
    private static $messages = [
        'category_id.exists' => 'Categoria no existente',
        'required' =>  'El campo :attribute es obligatorio',
        'color.required' => 'El color no es valido'
    ];
    public function index()
    {

        $products = DB::table('products')->orderBy('id','desc')->get();
        return response()->json(new ProductCollection($products), 200);
    }
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product),200);
    }

    public function image(Product $product){
        return response()->download(public_path(Storage::url($product->image3)),$product->name);
    }
    public function showByCar(Car $car){
        $this->authorize('showByCar', $car);

        return response()->json(new ProductCollection($car->products),200);
    }

    public function showByWish(WishList $wishList){

        $this->authorize('showByWish',$wishList);

        return response()->json(new ProductCollection($wishList->products),200);
    }
    public function store (Request $request)
    {

        $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'color' => 'required',
            'price' => 'required',
            'sale' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image1' => 'required|image|dimensions:min_width=200,min_height=200',
            'image2' => 'required|image|dimensions:min_width=200,min_height=200',
            'image3' => 'required|image|dimensions:min_width=200,min_height=200',
            'image4' => 'required|image|dimensions:min_width=200,min_height=200',
            'image5' => 'required|image|dimensions:min_width=200,min_height=200',

        ],self::$messages);
//

//        $product = Product::create($request->all());

        $product = new Product($request->all());

        $path1 = $request->image1->store('public/products');
        $path2 = $request->image2->store('public/products');
        $path3 = $request->image3->store('public/products');
        $path4 = $request->image4->store('public/products');
        $path5 = $request->image5->store('public/products');

        $product->image1 = $path1;
        $product->image2 = $path2;
        $product->image3 = $path3;
        $product->image4 = $path4;
        $product->image5 = $path5;

        $product->save();


        return  response()->json(new ProductResource($product),201);
    }
    public function storeByCar (Car $car, $id)
    {
        $this->authorize('storeByCar', $car);
        if(!$car->products()->where('product_id',$id)->exists()){
            $car->products()->save(Product::find($id));
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return  response()->json('El producto ya se encuentra en el carrito',200);
    }

    public function storeByWish(WishList $wishList, $id)
    {
        $this->authorize('storeByWish',$wishList);

        if(!$wishList->products()->where('product_id', $id)->exists()){
            $wishList->products()->save(Product::find($id));
            return response()->json(new ProductResource(Product::find($id)),200);
        }
        return response()->json('El producto ya se encuentra agregado en la lista de deseos',200);
    }



    public function deleteByCar(Car $car, $id){

        $this->authorize('deleteByCar',$car);

        if($car->products()->where('product_id', $id)->exists()){
            $car->products()->detach($id);
            return response()->json(new ProductResource(Product::find($id)),204);
        }
        return response()->json('Producto no existente',202);
    }


    public function deleteByWish(WishList $wishList, $id)
    {

        $this->authorize('deleteByWish' , $wishList);

//        $products = Product::all();
//
//        foreach ($products as $p){
//            if($p->id === $id){
        if($wishList->products()->where('product_id', $id)->exists()){
            $wishList->products()->detach($id);
            return response()->json(new ProductResource(Product::find($id)),204);
        }
//            }
//        }

        return response()->json('Producto no existente', 202);

    }

    public function clearCar(Car $car){

        $this->authorize('clearCar', $car);
        if($car->products()->exists()){
            $car->products()->detach();
            return response()->json('Productos eliminados del carrito',202);
        }

        return response()->json('No se encuentran productos en el carrito', 202);
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
        $request->validate([
//            'name' => 'required|string|unique:products,name,'.$product->id.'|max:255',
//            'description' => 'required',
//            'color' => 'required',
//            'price' => 'required',
//            'sale' => 'required',
            'category_id' => 'required|exists:categories,id'
        ], self::$messages);

        $product->update($request->all());
        return response()->json($product,200);

    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json(null,204);
    }
}
