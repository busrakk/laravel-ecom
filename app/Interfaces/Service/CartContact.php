<?php

namespace App\Interfaces\Service;
use Illuminate\Http\Request;

interface CartContact
{
    public function getAll();

    public function findDataById($id);

    public function insertToCart($data);

    public function updateCart($data, $id);

    public function deleteCart($id);

    public function getCartForDropdown();

    public function getCartByWhere($where, $column=['*']);

}
