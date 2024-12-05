<?php

namespace App\Http\Controllers\System\Order;

use App\Http\Controllers\ResourceController;
use App\Services\System\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends ResourceController
{
    public $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'orders';
    }

    public function folderName()
    {
        return 'order';
    }

    public function verifyPayment(Request $request)
    {
        $this->service->verifyPayment($request);
        return back()->with(['success' => 'Payment has been verified.']);
    }
}
