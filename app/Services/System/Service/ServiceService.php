<?php

namespace App\Services\System\Service;

use App\Models\Service as ModelsService;
use App\Services\Service;

class ServiceService extends Service
{
    public function __construct(ModelsService $model)
    {
        parent::__construct($model);
    }
}
