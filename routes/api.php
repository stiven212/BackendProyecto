<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\OrderBuy;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('login', [\App\Http\Controllers\UserController::class, 'authenticate']);

Route::get('products', [\App\Http\Controllers\ProductController::class, 'index']);

Route::get('products/{product}', [\App\Http\Controllers\ProductController::class, 'show']);



Route::get('comments',[\App\Http\Controllers\CommentController::class, 'index']);


Route::get('wish_list', function (){
    return \App\Models\WishList::all();

});

// categories

Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);

Route::get('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show']);

Route::get('categories/{category}/products', [\App\Http\Controllers\CategoryController::class, 'showProducts']);

Route::get('categories/{category}/products/{product}', [\App\Http\Controllers\CategoryController::class, 'showProduct']);

Route::get('cars/{car}/products', [\App\Http\Controllers\ProductController::class, 'showByCar']);

Route::post('cars/{car}/products/{id}', [\App\Http\Controllers\ProductController::class, 'storeByCar']);

Route::delete('cars/{car}/products/{product}', [\App\Http\Controllers\ProductController::class, 'deleteByCar']);



Route::get('wishes/{wishList}/products', [\App\Http\Controllers\ProductController::class, 'showByWish']);


Route::get('products/{product}/comments', [\App\Http\Controllers\CommentController::class, 'show']);



Route::group(['middleware' => ['jwt.verify']], function() {

    // User

    Route::get('user', [\App\Http\Controllers\UserController::class, 'getAuthenticatedUser']);

    // Products

    Route::post('products', [\App\Http\Controllers\ProductController::class, 'store']);

    Route::put('products/{product}', [\App\Http\Controllers\ProductController::class, 'update']);

    Route::delete('products/{product}', [\App\Http\Controllers\ProductController::class, 'delete']);

    // Categories

    Route::post('categories/{category}/products', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::put('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update']);

    Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'delete']);


    Route::get( 'orders', [\App\Http\Controllers\OrderController::class, 'index']);

    Route::get( 'orders/{orderBuy}', [\App\Http\Controllers\OrderController::class, 'show']);

    Route::get('orders/{orderBuy}/details', [\App\Http\Controllers\DetailsController::class, 'index']);

    Route::get('details/{detail}', [\App\Http\Controllers\DetailsController::class, 'show']);


    Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::put('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update']);

    Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'delete']);


    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store']);

    Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);

    Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'delete']);


});
