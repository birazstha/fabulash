<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    protected $model;
    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function run()
    {

        $items = [
            [
                'title' => 'Lash Extension Service',
                'rank' => 1,
            ],
            [
                'title' => 'Nails Service',
                'rank' => 2,
            ],
            [
                'title' => 'Manicure',
                'rank' => 3,
            ],
            [
                'title' => 'Pedicure',
                'rank' => 4,
            ],
        ];

        foreach ($items as $item) {
            $this->model->updateOrInsert(
                ['title' => $item['title']],
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
