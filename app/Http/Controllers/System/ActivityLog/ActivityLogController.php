<?php

namespace App\Http\Controllers\System\ActivityLog;

use App\Http\Controllers\ResourceController;
use App\Services\System\ActivityLog\ActivityLogService;

class ActivityLogController extends ResourceController
{
    protected $service;

    public function __construct(ActivityLogService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'activity-logs';
    }

    public function folderName()
    {
        return 'activity-log';
    }
}
