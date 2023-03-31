<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function user()
    {
        // $user = User::find(Auth::user()->id);
        $user = Auth::user();

        if($user){
            return response()->json([
                'data' => $user,
                'success' => true,
                'message' => 'Profile Successfully Found.',
                'status' => 'success'
            ]);
        }
    }

    public function update(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;

        $data->save();

        if($data){
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Profile Updated Successfully.',
                'status' => 'success'
            ]);
        }
    }

}
