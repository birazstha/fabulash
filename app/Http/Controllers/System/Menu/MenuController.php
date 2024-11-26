<?php

namespace App\Http\Controllers\System\Menu;

use App\Http\Controllers\ResourceController;
use App\Models\Menu;
use App\Services\System\Menu\MenuService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends ResourceController
{
    protected $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    // public function storeValidationRequest()
    // {
    //     return 'App\Http\Requests\System\MenuRequest';
    // }

    public function moduleName()
    {
        return 'menus';
    }

    public function folderName()
    {
        return 'menu';
    }
  
}
