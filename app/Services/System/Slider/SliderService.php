<?php

namespace App\Services\System\Slider;

use App\Models\Slider;
use App\Services\Service;

class SliderService extends Service
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }
}
