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

    public function update($id, $data)
    {
        return Brand::where('id', $id)->update($data);
    }

    public function getById($id)
    {
        return Brand::where('id', $id)->first();
    }

    public function getByWhere($column=['*'], $where)
    {
        return Brand::select($column)->where($where)->get();
    } 

    public function countBrand()
    {
        return Brand::where('status', Brand::STATUS_ACTIVE)->count();
    }


}