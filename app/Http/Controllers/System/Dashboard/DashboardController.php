<?php

namespace App\Http\Controllers\System\Dashboard;

use App\Http\Controllers\ResourceController;
use App\Services\System\Dashboard\DashboardService;

class DashboardController extends ResourceController
{
    public function __construct(DashboardService $service)
    {
        parent::__construct($service);
    }

    public function moduleName()
    {
        return 'dashboards';
    }

    public function folderName()
    {
        return 'dashboard';
    }
}
