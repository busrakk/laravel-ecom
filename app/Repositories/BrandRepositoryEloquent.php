<?php

namespace App\Repositories;
use App\Interfaces\Repository\BrandRepository;
use App\Models\Brand;

class BrandRepositoryEloquent implements BrandRepository{

    public function getAll()
    {
        // return Brand::all();
        return Brand::with(['products'])->get();
    }

    // delete
    public function delete($id)
    {
        return Brand::where('id', $id)->delete();
    }

    public function insert($data)
    {
        return Brand::create($data);
    }

    public function getByWhere($column=['*'], $where)
    {
        return Brand::select($column)->where($where)->get();
    } 

}