<?php

namespace App\Http\Controllers\System\LoginLog;

use App\Http\Controllers\ResourceController;
use App\Services\System\LoginLog\LoginLogService;

class LoginLogController extends ResourceController
{
    protected $service;

    public function __construct(LoginLogService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'login-logs';
    }

    public function folderName()
    {
        return 'login-log';
    }
}
