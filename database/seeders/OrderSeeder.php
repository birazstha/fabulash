<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    protected $model, $customer;
    public function __construct(
        Order $model,
        Customer $customer
    ) {
        $this->model = $model;
        $this->customer = $customer;
    }

    public function run()
    {
        $items = [
            [
                'customer_id' => $this->customer->where('username', 'dibya_maharjan')->value('id'),
                'order_number' => generateOrderId(),
                'total_amount' => 5000,
                'delivery_address' => 'Endeavor Nepal, Link Marga',
                'payment_status' => 'unverified',
            ],
            [
                'customer_id' => $this->customer->where('username', 'sujata_bajracharya')->value('id'),
                'order_number' => generateOrderId(),
                'total_amount' => 10000,
                'delivery_address' => 'Pimbahal',
                'payment_status' => 'unverified',
            ],
        ];

        foreach ($items as $item) {
            $this->model->updateOrInsert(
                ['order_number' => $item['order_number']],
                [
                    'customer_id' => $item['customer_id'],
                    'order_number' => $item['order_number'],
                    'total_amount' => $item['total_amount'],
                    'payment_status' => $item['payment_status'],
                    'delivery_address' => $item['delivery_address'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
