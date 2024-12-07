<?php

namespace App\Services\System\Inventory;

use App\Models\Inventory;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryService extends Service
{
    protected $product;
    public function __construct(Inventory $model, Product $product)
    {
        parent::__construct($model);
        $this->product = $product;
    }

    public function createPageData($request)
    {
        return [
            'products' => $this->product->active()->pluck('title', 'id')
        ];
    }

    public function editPageData($id)
    {
        return [
            'item' => $this->getItemById($id),
            'products' => $this->product->active()->pluck('title', 'id')
        ];
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['user_id'] = authUser()->id;
            $data['transaction_type'] = 'addition';
            $this->model->create($data);
            $product = $this->product->find($request->product_id);
            $product->update([
                'stock' => $product->stock + $request->quantity
            ]);
        });
    }
}
