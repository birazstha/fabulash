<?php

namespace App\Services\System\Dashboard;

use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service as ModelsService;
use App\Services\Service;
use Illuminate\Http\Request;

class DashboardService extends Service
{
    protected $product, $order, $customer, $enquiry;
    public function __construct(
        ModelsService $model,
        Product $product,
        Order $order,
        Customer $customer,
        Enquiry $enquiry,
    ) {
        parent::__construct($model);
        $this->product = $product;
        $this->order = $order;
        $this->customer = $customer;
        $this->enquiry = $enquiry;
    }

    public function indexPageData(Request $request)
    {
        return  [
            'items' => $this->getAllData($request),
            'products' => $this->product->count(),
            'orders' => $this->order->count(),
            'customers' => $this->customer->count(),
            'enquiries' => $this->enquiry->count(),
        ];
    }
}
