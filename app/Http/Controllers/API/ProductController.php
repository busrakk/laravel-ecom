<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\ProductContact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user' => 'bail|required',
            // 'category' => 'bail|required',
            // 'brand' => 'bail|required',
            'name' => 'bail|required|max:191',
            'description' => 'bail|required|max:191',
            'price' => 'bail|required|max:20',
            'quantity' => 'bail|required|max:4',
            //'image1' => 'bail|required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
                'status' => 'validation-error'
            ]);
        }

        $data = [
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'quantity' => $request->quantity,
            'in_stock' => $request->in_stock,
            'featured' => $request->featured,
            'popular' => $request->popular,
            'status' => $request->status,
            'image1' => $request->image1
        ];

        if($request->hasFile('image1')){
            $file = $request->file('image1');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension; 
            $file->move('uploads/images/product/', $filename); 

            $data['image1'] = 'uploads/images/product/'.$filename;
        }

        return response()->json($this->productService->saveProduct($data));

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

    public function byFeatured()
    {
       $productList = Product::where('featured', '=', 1)->with(['user', 'brand', 'images', 'categories' ])->get();
        
        if($productList){
            return response()->json([
                'data' => $productList,
                'success' => true,
                'message' => 'Product by Featured Successfully Found.',
                'status' => 'success'
            ]);
        }else{
            return [
                'message' => 'Product Not Found!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }

}
