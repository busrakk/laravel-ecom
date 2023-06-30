<?php

namespace App\Services;

use App\Interfaces\Repository\CategoryRepository;
use App\Interfaces\Service\CategoryContact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryService implements CategoryContact{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $response = $this->categoryRepository->getAll();

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }
    }

    // delete
    public function deleteCategory($id)
    {
        try {
            $response = $this->categoryRepository->delete($id);

            if($response){
                return [
                    'success' => true,
                    'message' => 'Kategori Başarıyla Silindi',
                    'status' => 'success'
                ];
            }
        }catch (\Throwable $th) {
            return [
                'message' => 'Bir şeyler ters gitti!',
                'status' => false
            ];
        }
    }

    public function findDataById($id)
    {
        $response = $this->categoryRepository->getById($id);

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }else{
            return [
                'message' => 'Kategori Bulunamadı!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }

    public function saveCategory($data)
    {
        try {
            $response = $this->categoryRepository->insert($data);

            if($response){
                return [
                    'success' => true,
                    'message' => 'Kategori Başarıyla Eklendi',
                    'status' => 'success'
                ];
            }
        }catch (\Throwable $th) {
            return [
                'message' => 'Something went wrong!',
                'status' => false
            ];
        }

    }

    public function updateCategory($data, $id)
    {
        try {
            $response = $this->categoryRepository->update($id, $data);

            if($response){
                return [
                    'success' => true,
                    'message' => 'Kategori Başarıyla Güncellendi',
                    'status' => 'success'
                ];
            }
        }catch (\Throwable $th) {
            return [
                'message' => 'Something went wrong!',
                'status' => false
            ];
        }
    }

    public function getCategoryForDropdown()
    {
        $response = $this->categoryRepository->getByWhere(['id', 'name'], [['status', Category::STATUS_ACTIVE]]);

        return [
            'data' => $response,
            'success' => true,
            'status' => 'success'
        ];
    }

}