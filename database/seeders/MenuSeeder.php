<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class MenuSeeder extends Seeder
{
    protected $model;
    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function run()
    {

        $items = [
            [
                'title' => 'Home',
                'href' => '#home',
                'rank' => 1,
            ],
            [
                'title' => 'Products',
                'href' => '#product',
                'rank' => 2,
            ],
            [
                'title' => 'About Us',
                'href' => '#about-us',
                'rank' => 3,
            ],
            [
                'title' => 'Contact Us',
                'href' => '#contact-us',
                'rank' => 4,
            ],
        ];

        foreach ($items as $item) {
            $this->model->updateOrInsert(
                ['href' => $item['href']],
                [
                    'title' => $item['title'],
                    'rank' => $item['rank'],
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => 1,
                ]
            );
        }
    }
}
