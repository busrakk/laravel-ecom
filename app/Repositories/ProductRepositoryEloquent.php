<?php

namespace App\Repositories;
use App\Interfaces\Repository\ProductRepository;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepositoryEloquent implements ProductRepository{

    public function getAll()
    {
        return Product::with(['user', 'brand', 'images', 'categories' ])->get();
    }

    public function getById($id)
    {
        return Product::where('id', $id)->with(['user', 'brand', 'images', 'categories' ])->first();
        // return Brand::where('id', $id)->with(['product'])->get();
    }

    public function getById1($id)
    {
        return Product::where('id', $id)->first();
    }

    public function insert($data)
    {
        return Product::create($data);
    }

    // delete
    public function delete($id)
    {
        return Product::where('id', $id)->delete();
    }

}