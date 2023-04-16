<?php

namespace App\Interfaces\Service;
use Illuminate\Http\Request;

interface BrandContact
{
    public function getAll();
    public function deleteBrand($id);
}