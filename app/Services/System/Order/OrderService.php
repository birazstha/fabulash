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

   
}
