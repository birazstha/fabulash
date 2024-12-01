<?php

namespace App\Services\System\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\Service as ModelsService;
use App\Services\Service;
use Illuminate\Http\Request;

class DashboardService extends Service
{
    protected $product, $order;
    public function __construct(
        ModelsService $model,
        Product $product,
        Order $order
    ) {
        parent::__construct($model);
        $this->product = $product;
        $this->order = $order;
    }

    public function indexPageData(Request $request)
    {
        return  [
            'items' => $this->getAllData($request),
            'products' => $this->product->count(),
            'orders' => $this->order->count(),
        ];
    }
}
