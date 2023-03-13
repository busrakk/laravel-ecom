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

    // all category
    public function index()
    {
        return response()->json($this->productService->getAll());
    }

    public function find($id)
    {
        return response()->json($this->productService->getById($id));
    }

}
