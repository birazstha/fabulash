<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $items = [
            [
                'title' => 'Steady',
                'rank' => 1,
                'short_description' => 'Short description for Steady',
                'description' => 'Detailed description for Steady. Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.Detailed description for Steady.',
                'price' => 1000,
                'sub_category_id' => 2
            ],
            [
                'title' => 'Bestie Adhesive',
                'rank' => 2,
                'short_description' => 'Short description for Bestie Adhesive',
                'description' => 'Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. Detailed description for Bestie Adhesive. ',
                'price' => 1500,
                'sub_category_id' => 3
            ],
        ];

        foreach ($items as $user) {
            $this->model->firstOrCreate (
                ['title' => $user['title']],
                [
                    'title' => $user['title'],
                    'rank' => $user['rank'],
                    'short_description' => $user['short_description'],
                    'description' => $user['description'],
                    'price' => $user['price'],
                    'sub_category_id' => $user['sub_category_id'],
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => 1,
                ]
            );
        }
    }
}
