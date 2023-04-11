<?php

namespace App\Interfaces\Service;
use Illuminate\Http\Request;

interface ProductContact
{
    public function getAll();
    public function getById($id);
    public function saveProduct($data);
    public function findDataById($id);
    public function deleteProduct($id);
}