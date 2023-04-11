<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface CategoryRepository
{
   public function getAll();
   public function getByWhere($column=['*'], $where);
}