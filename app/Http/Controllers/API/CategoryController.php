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

    public function findProduct($id)
    {
        return response()->json($this->categoryService->getByProduct($id));
    }

}
