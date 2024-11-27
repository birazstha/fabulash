    {{-- Dashboard --}}
    <x-system.sidebar-item :input="[
        'title' => 'Dashboard',
        'route' => 'home',
        'icon' => 'fas fa-home',
        'permission' => checkPermission('home', 'GET'),
    ]" />


    {{-- Product --}}
    <x-system.sidebar-item :input="[
        'title' => 'Product Management',
        'route' => 'products',
        'icon' => 'fas fa-box-open',
        'permission' => checkPermission('products', 'GET'),
    ]" />

    {{-- Inventory --}}
    <x-system.sidebar-item :input="[
        'title' => 'Inventory Management',
        'route' => 'inventories',
        'icon' => 'fas fa-warehouse',
        'permission' => checkPermission('inventories', 'GET'),
    ]" />


    {{-- Customer --}}
    <x-system.sidebar-item :input="[
        'title' => 'Customer Management',
        'route' => 'customers',
        'icon' => 'fa fa-users',
        'permission' => checkPermission('customers', 'GET'),
    ]" />


    {{-- Order --}}
    <x-system.sidebar-item :input="[
        'title' => 'Order Management',
        'route' => 'orders',
        'icon' => 'fab fa-opencart',
        'permission' => checkPermission('orders', 'GET'),
    ]" />

    {{-- Gallery --}}
    <x-system.sidebar-item :input="[
        'title' => 'Gallery Management',
        'route' => 'galleries',
        'icon' => 'fa fa-icons',
        'permission' => checkPermission('galleries', 'GET'),
    ]" />


    {{-- Menu Management --}}
    <x-system.sidebar-item :input="[
        'title' => 'Menu Management',
        'route' => 'menus',
        'icon' => 'fas fa-list',
        'permission' => checkPermission('menus', 'GET'),
    ]" />


    {{-- Testimonials --}}
    <x-system.sidebar-item :input="[
        'title' => 'Testimonial Management',
        'route' => 'testimonials',
        'icon' => 'fas fa-comment-dots',
        'permission' => checkPermission('testimonials', 'GET'),
    ]" />


    {{-- Basic Setup --}}
    <x-system.sidebar-item :input="[
        'title' => 'Basic Setup',
        'icon' => 'fas fa-cog parent-icon',
        'hasSubmenu' => true,
        'subMenus' => [
            //Category
            [
                'title' => 'Category Management',
                'route' => 'categories',
                'icon' => 'fas fa-list',
                'permission' => checkPermission('categories', 'GET'),
            ],
    
            // Sliders
            [
                'title' => 'Slider Management',
                'route' => 'sliders',
                'icon' => 'fas fa-images',
                'permission' => checkPermission('sliders', 'GET'),
            ],

            //Email Template
            [
                'title' => 'Email Templates ',
                'route' => 'email-templates',
                'icon' => 'fas fa-envelope-open-text',
                'permission' => checkPermission('menus', 'GET'),
            ],
        ],
    ]" />


    {{-- User Management --}}
    <x-system.sidebar-item :input="[
        'title' => 'User Management',
        'icon' => 'fas fa-user-clock',
        'hasSubmenu' => true,
        'subMenus' => [
            [
                'title' => 'Users',
                'route' => 'users',
                'icon' => 'fas fa-users',
                'permission' => checkPermission('users', 'GET'),
            ],
            [
                'title' => 'Roles',
                'route' => 'roles',
                'icon' => 'fas fa-user-tie',
                'permission' => checkPermission('roles', 'GET'),
            ],
            [
                'title' => 'Modules',
                'route' => 'modules',
                'icon' => 'fas fa-list-ol',
                'permission' => checkPermission('modules', 'GET'),
            ],
        ],
    ]" />



    {{-- System Config --}}
    <x-system.sidebar-item :input="[
        'title' => 'System Config',
        'route' => 'configs',
        'icon' => 'fas fa-wrench',
        'permission' => checkPermission('configs', 'GET'),
    ]" />

    {{-- Log Management --}}
    <x-system.sidebar-item :input="[
        'title' => 'Logs Management',
        'icon' => 'fas fa-history',
        'hasSubmenu' => true,
        'subMenus' => [
            [
                'title' => 'Activity Log',
                'route' => 'activity-logs',
                'icon' => 'fas fa-chart-line',
                'permission' => checkPermission('activity-logs', 'GET'),
            ],
            [
                'title' => 'Login Logs',
                'route' => 'login-logs',
                'icon' => 'fas fa-clipboard-list',
                'permission' => checkPermission('login-logs', 'GET'),
            ],
        ],
    ]" />

    {{-- Email Management --}}
    <x-system.sidebar-item :input="[
        'title' => 'Profile Management',
        'customRoute' => true,
        'route' => 'profile',
        'icon' => 'fas fa-user',
        'permission' => checkPermission('profile', 'GET'),
    ]" />
