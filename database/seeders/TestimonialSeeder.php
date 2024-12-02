<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    protected $model;

    public function __construct(Testimonial $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $items = [
            [
                'name' => 'Dibya Maharjan',
                'words' => 'Fabulash has completely transformed my self-care routine! Their pedicure services are amazing, and the team is so friendly and professional. Highly recommended!',
                'rank' => 1,
            ],
            [
                'name' => 'Sujata Bajracharya',
                'words' => 'I had such a relaxing experience at Fabulash. The attention to detail and care they put into their services is unmatched. I always leave feeling refreshed and pampered!',
                'rank' => 2,
            ],
        ];

        foreach ($items as $item) {
            $this->model->create(
                array_merge($item, ['status' => true])
            );
        }
    }
}
