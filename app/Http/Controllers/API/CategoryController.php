<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Repository\CategoryRepository;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    // all category
    public function index()
    {
        $response = $this->categoryRepository->getAll();

        if($response){
            return response()->json([
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ]);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'bail|required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
                'status' => 'validation-error'
            ]);
        }

        $data = [
            'category_name' => $request->category_name,
            'category_image' => $request->category_image,
        ];

        try{
            Category::create($data);

                return response()->json([
                    'success' => true,
                    'message' => 'Category Insert Successfuly',
                    'status' => 'success'
                ]);
        }catch(\Throwable $th){
            return response()->json([
                'message' => 'Something went wrong!',
                'status' => false
            ]); 
        }

    }


}
