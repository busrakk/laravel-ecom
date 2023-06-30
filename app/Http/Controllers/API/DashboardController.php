<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Repository\BrandRepository;
use App\Interfaces\Repository\CategoryRepository;
use App\Interfaces\Repository\ProductRepository;
use App\Interfaces\Repository\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $categoryRepository;
    private $brandRepository;
    private $productRepository;
    private $userRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                BrandRepository $brandRepository,
                                ProductRepository $productRepository,
                                UserRepository $userRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function dashboardData()
    {
        $cardData['countCategory'] = $this->categoryRepository->countCategory();
        $cardData['countBrand'] = $this->brandRepository->countBrand();
        $cardData['countProduct'] = $this->productRepository->countProduct();
        $cardData['countUser'] = $this->userRepository->countUserByWhere([['role_as', User::ROLE_USER]]);

        return response()->json([
            'cardData' => (object)$cardData,
            'success' => true,
            'status' => 'success'
        ]);
    }
}
