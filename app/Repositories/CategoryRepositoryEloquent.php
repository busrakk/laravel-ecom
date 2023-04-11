<?php

namespace App\Repositories;
use App\Interfaces\Repository\CategoryRepository;
use App\Models\Category;
use App\Models\Product;

class CategoryRepositoryEloquent implements CategoryRepository{

    public function getAll()
    {
        // return Category::all();
       return Category::with(['products'])->get();
    }

    // delete
    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }

    public function getByWhere($column=['*'], $where)
    {
        return Category::select($column)->where($where)->get();
    } 

}