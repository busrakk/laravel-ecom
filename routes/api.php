<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/allcategory', [CategoryController::class, 'index']);
Route::post('/allbrand', [BrandController::class, 'index']);
Route::post('/allproduct', [ProductController::class, 'index']);
Route::get('/product/{category_id}', [ProductController::class, 'find']);
Route::get('/product/category/{category_id}', [ProductController::class, 'byCategory']);
Route::get('/product/brand/{brand_id}', [ProductController::class, 'byBrand']);
Route::get('/featured', [ProductController::class, 'byFeatured']);
Route::get('/sell-product', [ProductController::class, 'bySale']);
Route::get('/search-product', [ProductController::class, 'bySearch']);


//protected
Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group( function(){
    Route::get('checkAuthenticated', function(){
        return response()->json(['message' => 'You are in', 'status'=>200], 200);
    });

    Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\API'], function(){
        // Category route
        Route::post('category-list', 'CategoryController@index');
        // Route::post('category-store', 'CategoryController@store');
        Route::post('/category-delete/{id}', 'CategoryController@destroy');
        // brand route
        Route::post('brand-list', 'BrandController@index');
        Route::post('/brand-delete/{id}', 'BrandController@destroy');
        Route::post('brand-store', 'BrandController@store');
        // product route
        Route::post('/product-list','ProductController@index');
    });
});

Route::middleware(['auth:sanctum'])->group( function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/user', [UserController::class, 'user']);
    Route::post('/user-update', [UserController::class, 'update']);
    Route::post('product-save', [ProductController::class, 'store']);
    Route::post('product-update/{id}', [ProductController::class, 'update']);
    Route::post('/product-user-list', [UserController::class, 'productByUser']);
    Route::post('product-details', [ProductController::class, 'find1']);
    Route::post('product-delete/{id}', [ProductController::class,'destroy']);
    Route::get('/product-user-count', [UserController::class, 'productByUserCount']);
    Route::post('/category-dropdown-list', [CategoryController::class,'getCategoryForDropdown']);
});

