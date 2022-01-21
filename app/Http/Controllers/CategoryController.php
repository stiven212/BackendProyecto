<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryController extends Controller
{
    //

    public function index()
    {
        return response()->json(Category::all(),200);
    }
    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category),200);
    }

    public function showProducts(Category $category)
    {

        $products = DB::table('products')->where('category_id', '=', $category->id)->paginate(12);
        return response()->json(new ProductCollection($products),200);

            //response()->json(new ProductCollection($category->products), 200);

    }

    public function showProduct(Category $category, Product $product)
    {
        $product = $category->products()->where('id', $product->id)->firstOrFail();
        return response()->json(new ProductResource($product),200);
    }



    public function store (Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:categories',
            'description' => 'required'
        ], [
            'unique' => 'El :attribute ya existe',
        ]);

        $category= Category::create($request->all());

        return  response()->json($category,201);
    }

    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required|string|unique:categories,name,'.$category->id.'|max:255',
           // 'description' => 'required',
        ], [
            'unique' => 'El :attribute ya existe',
        ]);

        $category->update($request->all());

        return response()->json($category,200);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json(null,204);
    }
}
