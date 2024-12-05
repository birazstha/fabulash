<?php

namespace App\Services\System\Order;

use App\Models\Order;
use App\Services\Service;
use Carbon\Carbon;

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

        if ($request->filled('dates')) {
            $dateRangeParts = explode(" - ", $request->dates);
            $startDate = Carbon::createFromFormat('Y/m/d', $dateRangeParts[0])->startOfDay();
            $endDate = Carbon::createFromFormat('Y/m/d', $dateRangeParts[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function verifyPayment($request)
    {
        $order = $this->model->where('order_number', $request->order_number)->first();
        $order->update([
            'payment_verified_by' => authUser()->id,
            'payment_verified_at' => Carbon::now()->toDateTimeString(),
            'payment_status' => 'verified'
        ]);

        return $order->id;
    }
}
