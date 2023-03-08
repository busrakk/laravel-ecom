<?php

namespace App\Repositories;
use App\Interfaces\Repository\CategoryRepository;
use App\Models\Category;

class CategoryRepositoryEloquent implements CategoryRepository{

    public function getAll()
    {
        return Category::all();
    }

}