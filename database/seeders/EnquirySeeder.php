<?php

namespace Database\Seeders;

use App\Models\Enquiry;
use App\Models\Role;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    protected $model;

    public function __construct(Enquiry $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->truncate();
        $items = [
            [
                'name' => 'Urmila Shrestha',
                'email' => 'shresthaurmila11@gmail.com',
                'contact' => '9844390741',
                'message' => 'Hello! I am Urmila. I have a small enquiry regarding pedicure. Can we have a short meeting?'
            ],
            [
                'name' => 'Ranju Kumari Shrestha',
                'email' => 'ranjustha@gmail.com',
                'contact' => '9801190741',
                'message' => 'Hello! I am Ranju,from Bardibas. I wan to schedule a appointment for my nails. Can I get more info regarding it?'
            ],

        ];

        foreach ($items as $item) {
            $this->model->create($item);
        }
    }
}
