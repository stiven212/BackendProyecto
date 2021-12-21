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

Route::get('categories', [\App\Http\Controllers\CategoryController::class, 'index']);

Route::get('wish_list', function (){
    return \App\Models\WishList::all();

});

Route::get('categories/{category}/products', [\App\Http\Controllers\ProductController::class, 'index']);


Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', [\App\Http\Controllers\UserController::class, 'getAuthenticatedUser']);

    Route::post('products', [\App\Http\Controllers\ProductController::class, 'store']);

    Route::post('categories/{category}/products', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::put('products/{product}', [\App\Http\Controllers\ProductController::class, 'update']);

    Route::delete('products/{product}', [\App\Http\Controllers\ProductController::class, 'delete']);

    Route::get( 'orders', [\App\Http\Controllers\OrderController::class, 'index']);

    Route::get( 'orders/{order}', [\App\Http\Controllers\OrderController::class, 'show']);

    Route::get('details', [\App\Http\Controllers\DetailsController::class, 'index']);

    Route::get('details/{details}', [\App\Http\Controllers\DetailsController::class, 'show']);

    Route::get('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show']);

    Route::post('categories', [\App\Http\Controllers\CategoryController::class, 'store']);

    Route::put('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update']);

    Route::delete('categories/{category}', [\App\Http\Controllers\CategoryController::class, 'delete']);

    Route::get('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'show']);

    Route::post('comments', [\App\Http\Controllers\CommentController::class, 'store']);

    Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);

    Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'delete']);


});
