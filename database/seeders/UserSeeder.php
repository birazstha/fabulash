<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'role_id' => $this->role->where('slug', 'super_admin')->value('id'),
                'password' => Hash::make('123admin@'),
            ],
            [
                'name' => 'Biraj Shrestha',
                'email' => 'birajshrestha51@gmail.com',
                'username' => 'biraj_shrestha',
                'role_id' => $this->role->where('slug', 'admin')->value('id'),
                'password' => Hash::make('Biraj@123'),
            ],

        ];

        foreach ($users as $user) {
            User::updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                    'is_password_set' => true,
                    'username' => $user['username'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}
