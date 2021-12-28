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



// Comments

Route::get('comments',[\App\Http\Controllers\CommentController::class, 'index']);

Route::get('products/{product}/comments', [\App\Http\Controllers\CommentController::class, 'showComments']);

Route::get('products/{product}/comments', [\App\Http\Controllers\CommentController::class, 'show']);



// categories

Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);

Route::get('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show']);

Route::get('categories/{category}/products', [\App\Http\Controllers\CategoryController::class, 'showProducts']);

Route::get('categories/{category}/products/{product}', [\App\Http\Controllers\CategoryController::class, 'showProduct']);





Route::group(['middleware' => ['jwt.verify']], function() {

    // User

    Route::get('user', [\App\Http\Controllers\UserController::class, 'getAuthenticatedUser']);
    Route::post('/logout', [\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/car',[\App\Http\Controllers\UserController::class, 'createCar']);
    Route::get('cars', [\App\Http\Controllers\UserController::class, 'showCar']);
    Route::post('wish', [\App\Http\Controllers\UserController::class, 'createWish']);
    Route::get('wishes', [\App\Http\Controllers\UserController::class, 'showWish']);
    Route::get('order',[\App\Http\Controllers\UserController::class, 'showOrders']);
    Route::put('user', [\App\Http\Controllers\UserController::class, 'update']);

    // Products

    Route::get('products/{product}/image', [\App\Http\Controllers\ProductController::class, 'image']);

    Route::post('products', [\App\Http\Controllers\ProductController::class, 'store']);

    Route::put('products/{product}', [\App\Http\Controllers\ProductController::class, 'update']);

    Route::delete('products/{product}', [\App\Http\Controllers\ProductController::class, 'delete']);


    // Categories

    Route::post('categories/{category}/products', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::put('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update']);

    Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'delete']);

    // Orders

    Route::get( 'orders', [\App\Http\Controllers\OrderController::class, 'index']);

    Route::get( 'orders/{orderBuy}', [\App\Http\Controllers\OrderController::class, 'show']);

    Route::post('orders', [\App\Http\Controllers\OrderController::class, 'store']);

    Route::get('orders/{orderBuy}/details/{buyDetail}', [\App\Http\Controllers\OrderController::class, 'showDetail']);



    // Details


    Route::post('orders/{orderBuy}/details',[\App\Http\Controllers\DetailsController::class, 'store']);

    Route::get('details/{buyDetail}', [\App\Http\Controllers\DetailsController::class, 'show']);

    Route::get('orders/{orderBuy}/details', [\App\Http\Controllers\DetailsController::class, 'index']);

    Route::post('details/{buyDetail}/cars/{car}', [\App\Http\Controllers\ProductController::class, 'storeByDetail']);






    //Carrito
    Route::get('cars/{car}/products', [\App\Http\Controllers\ProductController::class, 'showByCar']);
    Route::post('cars/{car}/products/{id}', [\App\Http\Controllers\ProductController::class, 'storeByCar']);
    Route::delete('cars/{car}/products/{id}',[\App\Http\Controllers\ProductController::class, 'deleteByCar']);
    Route::delete('cars/{car}/products', [\App\Http\Controllers\ProductController::class, 'clearCar']);

    // Lista de deseos

    Route::get('wishes/{wishList}/products', [\App\Http\Controllers\ProductController::class, 'showByWish']);

    Route::post('wishes/{wishList}/products/{id}', [\App\Http\Controllers\ProductController::class, 'storeByWish']);

    Route::delete('wishes/{wishList}/products/{id}', [\App\Http\Controllers\ProductController::class, 'deleteByWish']);



    // Comments

    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store']);

    Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);

    Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'delete']);


});
