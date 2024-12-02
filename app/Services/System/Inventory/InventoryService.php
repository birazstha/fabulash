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
            // $query->where('title', 'LIKE',  '%' . $request->keyword . '%');

            $query->whereHas('product', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->keyword . '%');
            });
        }

        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
