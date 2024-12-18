<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    protected $model;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $users = [
            [
                'name' => 'Urmila Shrestha',
                'username' => 'urmila_shrestha',
                'contact_number' => '9876543210',
                'address' => 'Koteshwor, Kathmandu',
                'password' => Hash::make('Urmila@123'),
                'email' => 'urmila@gmail.com',
                'google_avatar' => null,

            ],
            [
                'name' => 'Sujata Bajracharya',
                'username' => 'sujata_bajracharya',
                'contact_number' => '9806523456',
                'address' => 'Pimbahal, Lalitpur',
                'password' => Hash::make('Sujata@123'),
                'email' => 'sujata@gmail.com',
                'google_avatar' => null,

            ],
        ];

        foreach ($users as $user) {
            $this->model->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'contact_number' => $user['contact_number'],
                    'address' => $user['address'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
