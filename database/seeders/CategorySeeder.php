<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $categories = [
            [
                'title' => 'Lashes Products', // Parent category
                'rank' => 1,
                'subcategories' => [
                    [
                        'title' => 'Accessories & Tools',
                        'rank' => 1,

                    ],
                    [
                        'title' => 'Liquids',
                        'rank' => 2,
                    ],
                    [
                        'title' => 'Lash Tray',
                        'rank' => 3,
                    ],
                    [
                        'title' => 'Tweezers',
                        'rank' => 4,
                    ],
                ],
            ],
            [
                'title' => 'Nail Extension', // Parent category
                'rank' => 2,
                'subcategories' => [
                    [
                        'title' => 'Starter Kits',
                        'rank' => 1,
                    ],
                    [
                        'title' => 'Nail Files and Buffers',
                        'rank' => 2,

                    ],
                ],
            ],
        ];

        foreach ($categories as $category) {
            // Insert or update parent category and retrieve its ID
            $parentId = DB::table('categories')->updateOrInsert(
                ['title' => $category['title']], // Unique field
                [
                    'parent_id' => null, // No parent for main category
                    'rank' => $category['rank'],
                    'status' => true,
                    'created_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            // Retrieve the ID of the parent category
            $parentId = DB::table('categories')
                ->where('title', $category['title'])
                ->value('id');

            // Insert subcategories
            if (isset($category['subcategories'])) {
                foreach ($category['subcategories'] as $subcategory) {
                    DB::table('categories')->updateOrInsert(
                        ['title' => $subcategory['title']], // Unique field
                        [
                            'parent_id' => $parentId, // Assign parent ID
                            'rank' => $subcategory['rank'],
                            'status' => true,
                            'created_by' => 1,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }
        }
    }
}
