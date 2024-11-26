<?php

namespace App\Http\Controllers\System\Slider;

use App\Http\Controllers\ResourceController;
use App\Services\System\Slider\SliderService;

class SliderController extends ResourceController
{
    protected $service;

    public function __construct(SliderService $service)
    {
        $this->service = $service;
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\SliderRequest';
    }

    public function moduleName()
    {
        return 'sliders';
    }

    public function folderName()
    {
        return 'slider';
    }
}
