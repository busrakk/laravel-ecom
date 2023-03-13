<?php

namespace App\Services;

use App\Interfaces\Repository\ProductRepository;
use App\Interfaces\Service\ProductContact;

class ProductService implements ProductContact{

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        $response = $this->productRepository->getAll();

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }
    }

    public function getById($id)
    {
        $response = $this->productRepository->getById($id);

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }else{
            return [
                'message' => 'Product Not Found!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }
}