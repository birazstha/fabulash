<?php

namespace App\Services\System\Order;

use App\Models\Order;
use App\Services\Service;

class OrderService extends Service
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->order_number)) {
            $query->where('order_number', 'LIKE',  '%' . $request->order_number . '%');
        }

        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
