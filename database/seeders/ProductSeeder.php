<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    protected $model, $category;

    public function __construct(Product $model, Category $category)
    {
        $this->model = $model;
        $this->category = $category;
    }

    public function run()
    {
        $categories = [
            'accessories-tools' => $this->getCategoryId('accessories-tools'),
            'single-use' => $this->getCategoryId('single-use'),
            'liquids' => $this->getCategoryId('liquids'),
            'lash-tray' => $this->getCategoryId('lash-tray'),
        ];

        $items = [
            // Accessories & Tools
            ['category_id' => $categories['accessories-tools'], 'title' => 'Mirror', 'rank' => 1, 'price' => 1000],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Hygrometer', 'rank' => 2, 'price' => 1500],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Glue Shaker', 'rank' => 3, 'price' => 2000],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Lash Tile', 'rank' => 4, 'price' => 1200],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Glue Canister', 'rank' => 5, 'price' => 800],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Water Bottle', 'rank' => 6, 'price' => 500],
            ['category_id' => $categories['accessories-tools'], 'title' => 'Practice Sponge', 'rank' => 7, 'price' => 400],

            // Single-Use
            ['category_id' => $categories['single-use'], 'title' => 'Lash Tape', 'rank' => 1, 'price' => 300],
            ['category_id' => $categories['single-use'], 'title' => 'Gel Pad', 'rank' => 2, 'price' => 500],
            ['category_id' => $categories['single-use'], 'title' => 'Microbud', 'rank' => 3, 'price' => 200],
            ['category_id' => $categories['single-use'], 'title' => 'Spoolie', 'rank' => 4, 'price' => 100],
            ['category_id' => $categories['single-use'], 'title' => 'Glue Ring', 'rank' => 5, 'price' => 50],
            ['category_id' => $categories['single-use'], 'title' => 'Applicator', 'rank' => 6, 'price' => 50],

            // Liquids
            ['category_id' => $categories['liquids'], 'title' => 'Steady', 'rank' => 1, 'price' => 2500],
            ['category_id' => $categories['liquids'], 'title' => 'Bestie Adhesive', 'rank' => 2, 'price' => 2000],
            ['category_id' => $categories['liquids'], 'title' => 'Gel Remover', 'rank' => 3, 'price' => 1800],
            ['category_id' => $categories['liquids'], 'title' => 'Super Bonder', 'rank' => 4, 'price' => 2200],
            ['category_id' => $categories['liquids'], 'title' => 'Lash Primer', 'rank' => 5, 'price' => 1500],
            ['category_id' => $categories['liquids'], 'title' => 'Lash Serum', 'rank' => 6, 'price' => 3000],
            ['category_id' => $categories['liquids'], 'title' => 'Lash Shampoo', 'rank' => 7, 'price' => 3000],

            // Lash Tray
            ['category_id' => $categories['lash-tray'], 'title' => 'Easy Fans', 'rank' => 1, 'price' => 5000],
            ['category_id' => $categories['lash-tray'], 'title' => 'Classic', 'rank' => 2, 'price' => 4000],
            ['category_id' => $categories['lash-tray'], 'title' => 'Volume', 'rank' => 3, 'price' => 4500],
            ['category_id' => $categories['lash-tray'], 'title' => 'Mega Volume', 'rank' => 4, 'price' => 6000],
            ['category_id' => $categories['lash-tray'], 'title' => 'YY Lashes', 'rank' => 5, 'price' => 5500],
        ];


        foreach ($items as $item) {
            $this->model->firstOrCreate(
                ['title' => $item['title']],
                [
                    'title' => $item['title'],
                    'rank' => $item['rank'],
                    'slug' => generateSlug($item['title']),
                    'short_description' => "Short description for {$item['title']}.",
                    'description' => "Detailed description for {$item['title']}.",
                    'price' => $item['price'],
                    'category_id' => $item['category_id'],
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => 1,
                ]
            );
        }
    }

    private function getCategoryId($slug)
    {
        return DB::table('categories')->where('slug', $slug)->value('id');
    }
}
