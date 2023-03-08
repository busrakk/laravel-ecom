<?php

namespace App\Repositories;
use App\Interfaces\Repository\ProductRepository;
use App\Models\Product;

class ProductRepositoryEloquent implements ProductRepository{

    public function getAll()
    {
        return Product::with(['user', 'brand'])->get();
    }

}