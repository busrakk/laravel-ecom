<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\BrandContact;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandContact $brandService)
    {
        $this->brandService = $brandService;
    }

    // all brand
    public function index()
    {
        return response()->json($this->brandService->getAll());
    }
}
