<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Dashboard Management',
                'route' => 'home',
            ],
            [
                'name' => 'Category Management',
                'route' => 'categories'
            ],
            [
                'name' => 'User Management',
                'route' => 'users'
            ],

            [
                'name' => 'Role Management',
                'route' => 'roles'
            ],

            [
                'name' => 'Permission Management',
                'route' => 'permissions'
            ],

            [
                'name' => 'Module Management',
                'route' => 'modules'
            ],

            [
                'name' => 'System Config',
                'route' => 'configs'
            ],

            [
                'name' => 'Profile Management',
                'route' => 'profile'
            ],



        ];

        foreach ($roles as $role) {
            Module::updateOrInsert(
                ['route' => $role['route']],
                [
                    'name' => $role['name'],
                ]
            );
        }
    }
}
