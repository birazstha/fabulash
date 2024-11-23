<?php

$getMethod = 'get';
$postMethod = 'post';
$putMethod = 'put';
$deleteMethod = 'delete';

$categoryBaseUrl = "/categories";
$userBaseUrl = "/users";
$homeBaseUrl = "/home";
$frontendUserBaseUrl = "/frontendUsers";
$roleBaseUrl = "/roles";
$configBaseUrl = "/configs";
$permissionsBaseUrl = "/permissions";
$moduleBaseUrl = "/modules";
return [

    [
        'name' => 'Dashboard',
        'icon' => "<i class='fa fa-home'></i>",
        'hasSubmodules' => false,
        'route' => $homeBaseUrl,
    ],

    [
        'name' => 'Category Management',
        'icon' => "<i class='fa fa-list'></i>",
        'hasSubmodules' => false,
        'route' => $categoryBaseUrl,
    ],

    //User Management
    [
        'name' => 'User Management',
        'icon' => "<i class='fa fa-user parent-icon'></i>",
        'hasSubmodules' => true,
        'submodules' => [
            [
                'name' => 'Users',
                'icon' => '<i class="fas fa-user-cog parent-icon"></i>',
                'hasSubmodules' => false,
                'route' => $userBaseUrl,

            ],

            [
                'name' => 'Roles',
                'icon' => '<i class="fas fa-user-tie parent-icon"></i>',
                'hasSubmodules' => false,
                'route' => '/roles',

            ],
            [
                'name' => 'Permissions',
                'icon' => '<i class="fas fa-check parent-icon"></i>',
                'hasSubmodules' => false,
                'route' => $permissionsBaseUrl,
            ],
            [
                'name' => 'Modules',
                'icon' => '<i class="fas fa-list-ol parent-icon"></i>',
                'hasSubmodules' => false,
                'route' => $moduleBaseUrl,
            ],
        ],
    ],

    [
        'name' => 'System Config',
        'icon' => '<i class="fas fa-cog parent-icon parent-icon"></i>',
        'hasSubmodules' => true,
        'submodules' => [
            [
                'name' => 'Configurations',
                'icon' => '<i class="fas fa-wrench"></i>',
                'hasSubmodules' => false,
                'route' => $configBaseUrl,

            ],
        ],
    ],
];
