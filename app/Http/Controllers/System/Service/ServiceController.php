<?php

namespace App\Http\Controllers\System\Service;

use App\Http\Controllers\ResourceController;
use App\Services\System\Service\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends ResourceController
{
    protected $service;

    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'services';
    }

    public function folderName()
    {
        return 'service';
    }
}
