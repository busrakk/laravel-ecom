<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface CategoryRepository
{
   public function getAll();
   public function delete($id);
   public function getByWhere($column=['*'], $where);
}