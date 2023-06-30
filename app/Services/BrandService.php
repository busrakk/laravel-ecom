<?php

namespace App\Services;

use App\Interfaces\Repository\BrandRepository;
use App\Interfaces\Service\BrandContact;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandService implements BrandContact{

    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll()
    {
        $response = $this->brandRepository->getAll();

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }
    }

    public function deleteBrand($id)
    {
        try{
            $response = $this->brandRepository->delete($id);

            if($response){
                return [
                    'success' => true,
                    'message' => "Marka Başarıyla Silindi.",
                    'status' => 'success'
                ];
            }
        }catch(\Throwable $th){
            return [
                'message' => "Bir şeyler ters gitti!",
                "status" => false
            ];
        }
    }

    public function saveBrand($data)
    {
        try {
            $response = $this->brandRepository->insert($data);

            if($response){
                return [
                    'data' => $response,
                    'success' => true,
                    'message' => 'Marka Başarıyla Eklendi.',
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
        $response = $this->brandRepository->getById($id);

        if($response){
            return [
                'data' => $response,
                'success' => true,
                'status' => 'success'
            ];
        }else{
            return [
                'message' => 'Marka Bulunamadı!',
                'success' => false,
                'status' => 'error'
            ];
        }
    }

    public function updateBrand($data, $id)
    {
        try {
            $response = $this->brandRepository->update($id, $data);

            if($response){
                return [
                    'success' => true,
                    'message' => 'Marka Başarıyla Güncellendi',
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

    public function getBrandForDropdown()
    {
        $response = $this->brandRepository->getByWhere(['id', 'name'], [['status', Brand::STATUS_ACTIVE]]);

        return [
            'data' => $response,
            'success' => true,
            'status' => 'success'
        ];
    }
}
