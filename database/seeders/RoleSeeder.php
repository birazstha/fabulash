<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super_admin'
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],

        ];

        foreach ($roles as $role) {
            Role::updateOrInsert(
                ['slug' => $role['slug']],
                [
                    'name' => $role['name'],
                ]
            );
        }
    }
}
