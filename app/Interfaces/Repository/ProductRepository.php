<?php

namespace App\Interfaces\Repository;
use Illuminate\Http\Request;

interface ProductRepository
{
    public function getAll();
    public function getById($id);
    public function insert($data);
    public function getById1($id);
    public function delete($id);
}