<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Repository\ProductRepository;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // all category
    public function index()
    {
        $response = $this->productRepository->getAll();

        if($response){
            return response()->json([
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ]);
        }

    }
    // // all product
    // public function index()
    // {
    //    // $brand = Brand::with(['products'])->get();
    //    //$products = Product::all();

    //    return Product::with(['user', 'categories'])->get();
    //   // return response(['products' => $products]);
    // //    return response([
    // //        'data' => $products,
    // //        'success' => true,
    // //        'status' => 'success'
    // //    ]);

    // }

    // public function detail($id)
    // {
    //     return Product::find($id);
    // }
}
