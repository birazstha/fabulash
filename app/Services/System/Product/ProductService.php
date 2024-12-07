<?php

namespace App\Services\System\Product;

use App\Models\Inventory;
use App\Models\Product;
use App\Services\Service;
use App\Services\System\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService extends Service
{
    protected $categoryService, $inventory;

    public function __construct(Product $model, CategoryService $categoryService, Inventory $inventory)
    {
        parent::__construct($model);
        $this->categoryService = $categoryService;
        $this->inventory = $inventory;
    }

    public function getAllData($request)
    {
        $query = $this->query()->with('category');
        if (isset($request->keyword)) {
            $query->where('title', 'LIKE',  '%' . $request->keyword . '%');
        }

        if (isset($request->category_id)) {
            // $query->whereHas('subCategory', function ($subQuery) use ($request) {
            //     $subQuery->where('parent_id', $request->category_id);
            // });

            $query->where('category_id', $request->category_id);
        }

        if (isset($request->sub_category_id)) {
            $query->where('sub_category_id', $request->sub_category_id);
        }
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function indexPageData(Request $request)
    {
        $data = $this->getAllData($request);
        $data->transform(function ($product) {
            $product->stock = $this->calculateStock($product->id);
            return $product;
        });

        return  [
            'items' => $data
        ];
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

    public function showPageData(Request $request, $id)
    {
        $item = $this->getItemById($id);
        $item->stock = $this->calculateStock($id);
        return  [
            'item' => $item,
        ];
    }

    public function calculateStock($productId)
    {
        $stockItems =  $this->inventory->where(['product_id' => $productId, 'transaction_type' => 'addition'])->get();
        return collect($stockItems)->sum('quantity');
    }
}
