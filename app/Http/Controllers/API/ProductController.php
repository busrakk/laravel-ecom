<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\ProductContact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductContact $productService)
    {
        $this->productService = $productService;
    }

    // all product
    public function index()
    {
        return response()->json($this->productService->getAll());
    }

  
    public function find($id)
    {
        return response()->json($this->productService->getById($id));
    }

    public function byCategory(Request $request)
    {
        $category_id = $request->category_id;
        $productList = Product::where('category_id', $category_id)->with('categories', 'brand', 'user')->get();
        
        if($productList){
            return response()->json([
                'data' => $productList,
                'success' => true,
                'message' => 'Product by Category Successfully Found.',
                'status' => 'success'
            ]);
        }
    }

    public function byBrand(Request $request)
    {
        $brand_id = $request->brand_id;
        $productList = Product::where('brand_id', $brand_id)->with('categories', 'brand', 'user')->get();
        
        if($productList){
            return response()->json([
                'data' => $productList,
                'success' => true,
                'message' => 'Product by Brand Successfully Found.',
                'status' => 'success'
            ]);
        }
    }

}
