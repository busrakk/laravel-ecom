<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface BrandRepository
{
    public function getAll();
    public function delete($id);
    public function getById($id);
    public function insert($data);
    public function update($id, $data);
    public function getByWhere($column=['*'], $where);
    public function countBrand();
}
