<?php

namespace App\Interfaces\Service;
use Illuminate\Http\Request;

interface CategoryContact
{
    public function getAll();
    public function deleteCategory($id);
    public function getCategoryForDropdown();
}