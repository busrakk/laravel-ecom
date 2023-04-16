<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface BrandRepository
{
    public function getAll();
    public function delete($id);
}