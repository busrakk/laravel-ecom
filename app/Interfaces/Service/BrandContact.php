<?php

namespace App\Interfaces\Service;
use Illuminate\Http\Request;

interface BrandContact
{
    public function getAll();
    public function deleteBrand($id);
    public function findDataById($id);
    public function saveBrand($data);
    public function updateBrand($data, $id);
    public function getBrandForDropdown();
}