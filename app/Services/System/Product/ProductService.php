<?php

namespace App\Services\System\Product;

use App\Models\Product;
use App\Services\Service;
use App\Services\System\Category\CategoryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductService extends Service
{
    protected $categoryService;

    public function __construct(Product $model, CategoryService $categoryService)
    {
        parent::__construct($model);
        $this->categoryService = $categoryService;
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('title', 'LIKE',  '%' . $request->keyword . '%');
        }

        if (isset($request->category_id)) {
            $query->whereHas('subCategory', function ($subQuery) use ($request) {
                $subQuery->where('parent_id', $request->category_id);
            });
        }

        if (isset($request->sub_category_id)) {
            $query->where('sub_category_id', $request->sub_category_id);
        }
        return $query->orderBy('updated_at', 'DESC')->get();
    }


    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            if (isset($request->productId)) {
                $model = $this->getItemById($request->productId);
            } else {
                $data['created_by'] = authUser()->id;
                $model = $this->model->create($data);
            }

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

    public function delete($request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $data = $this->getItemById($id);
            foreach ($data->files()->get() as $file) {
                if (File::exists($file->path)) {
                    File::delete($file->path);
                }

                $file->delete();
            }
            $data->delete();
        });
    }
}
