<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\CategoryContact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryContact $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // all category
    public function index()
    {
        return response()->json($this->categoryService->getAll());
    }

    // delete
    public function destroy($id)
    {
        return response()->json($this->categoryService->deleteCategory($id));
    }

    public function find($id)
    {
        return response()->json($this->categoryService->findDataById($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
                'status' => 'validation-error'
            ]);
        }

        $data = [
            'name' => $request->name,
            'featured' => $request->featured,
            'status' => $request->status == true ? '1':'0'
        ];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension; 
            $file->move('uploads/images/category/', $filename); 

            $data['image'] = 'uploads/images/category/'.$filename;
        }

        return response()->json($this->categoryService->saveCategory($data));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
                'status' => 'validation-error'
            ]);
        }

        $data = [
            'name' => $request->name,
            'featured' => $request->featured,
            'status' => $request->status == true ? '1':'0'
        ];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension; 
            $file->move('uploads/images/category/', $filename); 

            $data['image'] = 'uploads/images/category/'.$filename;
        }

        return response()->json($this->categoryService->updateCategory($data, $id));
    }


    public function getCategoryForDropdown()
    {
        return response()->json($this->categoryService->getCategoryForDropdown());
    }

}
