<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Repository\BrandRepository;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    // all brand
    public function index()
    {
        $response = $this->brandRepository->getAll();

        if($response){
            return response()->json([
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ]);
        }

    }
}
