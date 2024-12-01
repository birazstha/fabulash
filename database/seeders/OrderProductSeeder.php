<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    protected $model;
    public function __construct(OrderProduct $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $items = [
            // Dibya's Order
            [
                'order_id' => 1,
                'product_id' => 1, // Steady
                'quantity' => 4,
            ],
            [
                'order_id' => 1,
                'product_id' => 2, // Bestie Adhesive
                'quantity' => 2,
            ],

            // Sujata's Order
            [
                'order_id' => 2,
                'product_id' => 2, // Bestie Adhesive
                'quantity' => 8,
            ],
        ];

        foreach ($items as $item) {
            $this->model->create([
                'order_id' => $item['order_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
