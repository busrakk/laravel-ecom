<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface BrandRepository
{
    public function getAll();
    public function delete($id);
    public function insert($data);
    public function getByWhere($column=['*'], $where);
}