<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\BrandContact;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandContact $brandService)
    {
        $this->brandService = $brandService;
    }

    // all brand
    public function index()
    {
        return response()->json($this->brandService->getAll());
    }

    // delete
    public function destroy($id)
    {
        return response()->json($this->brandService->deleteBrand($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages(),
                'status' => 'validation-error'
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'featured' => $request->featured,
            'status' => $request->status
        ];

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/images/logo/', $filename);

            # $data['logo'] = 'http://127.0.0.1:8000/uploads/images/logo/'.$filename;
            $data['logo'] = 'uploads/images/logo/'.$filename;
        }

        return response()->json($this->brandService->saveBrand($data));
    }

    public function getBrandForDropdown()
    {
        return response()->json($this->brandService->getBrandForDropdown());
    }
}
