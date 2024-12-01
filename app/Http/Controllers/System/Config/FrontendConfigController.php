<?php

namespace App\Http\Controllers\System\Config;

use App\Http\Controllers\ResourceController;
use App\Services\System\Config\FrontendConfigService;

class FrontendConfigController extends ResourceController
{
    protected $service;

    public function __construct(FrontendConfigService $service)
    {
        $this->service = $service;
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\FrontendConfigRequest';
    }

    public function moduleName()
    {
        return 'frontend-configs';
    }

    public function folderName()
    {
        return 'frontend-config';
    }
}
