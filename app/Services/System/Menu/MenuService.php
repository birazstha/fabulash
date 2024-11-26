<?php

namespace App\Services\System\Menu;

use App\Models\Menu;
use App\Services\Service;

class MenuService extends Service
{
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }
}
