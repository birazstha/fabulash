<?php

namespace App\Services\System\Inventory;

use App\Models\Inventory;
use App\Services\Service;

class InventoryService extends Service
{
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
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
}
