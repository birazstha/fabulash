<?php

namespace App\Services\System\Product;

use App\Models\Product;
use App\Services\Service;
use App\Services\System\Category\CategoryService;
use Illuminate\Support\Facades\DB;

class ProductService extends Service
{
    protected $categoryService;

    public function __construct(Product $model, CategoryService $categoryService)
    {
        parent::__construct($model);
        $this->categoryService = $categoryService;
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['created_by'] = authUser()->id;

            $data['price'] = 5000;
            $model = $this->model->create($data);

            foreach ($request->photo as $photo) {
                $fileData = [
                    'model' => $model,
                    'file' => $photo,
                    'path' => 'uploads/products'
                ];
                $this->storeBase64Image($fileData);
            }

            return $model->id;
        });
    }

    public function createPageData($request)
    {
        return [
            'categories' => $this->categoryService->getAllData($request)->pluck('title', 'id'),
            'status' => $this->status()
        ];
    }

    public function editPageData($id)
    {

        return [
            'item' => $this->getItemById($id),
            'categories' => $this->categoryService->getAllData(request())->pluck('title', 'id'),
            'status' => $this->status()
        ];
    }
}
