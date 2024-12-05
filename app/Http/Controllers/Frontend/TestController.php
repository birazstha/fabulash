<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    use FileTrait;

    public function uploadReceipt(Request $request)
    {
        DB::transaction(function () use ($request) {
            $order = Order::where('order_number', $request->order_number)->first();
            $this->storeImage($request->receipt, 'frontend/receipts', $order);
        });
    }
}
