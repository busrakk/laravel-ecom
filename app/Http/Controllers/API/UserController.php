<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function productByUser()
    {
        $products = Product::where('user_id', Auth::user()->id)->with(['user', 'brand', 'images', 'categories' ])->orderBy('created_at','DESC')->get();
      
        if($products){
            return [
                'data' => $products,
                'success' => true,
                'status' => 'success'
            ];
        }else{
            return [
                'message' => 'Product Not Found!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }

    public function productByUserCount()
    {
        $products = Product::where('user_id', Auth::user()->id)->with(['user', 'brand', 'images', 'categories' ])->orderBy('created_at','DESC')->count();
      
        if($products){
            return [
                'data' => $products,
                'success' => true,
                'status' => 'success'
            ];
        }else{
            return [
                'message' => 'Product Not Found!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }

}
