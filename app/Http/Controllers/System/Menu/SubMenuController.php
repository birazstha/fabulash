<?php

namespace App\Http\Controllers\System\Menu;

use App\Http\Controllers\ResourceController;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubMenuController extends ResourceController
{
    protected $model;

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\MenuRequest';
    }

    public function index(Request $request)
    {
        $data = [
            'indexUrl' => 'subMenu.sub-menu', // Adjust this to match your actual route name
            'items' => $this->model->where('type','children')->get(),
            'moduleName' => ucfirst($this->folderName()),
            'breadCrumb' => $this->breadcrumbForIndex()
        ];
          return view('system.' . $this->folderName() . '.index', $data);
    }

    public function moduleName()
    {
        return 'sub-menus';
    }

    public function folderName(){
        return 'subMenu';
    }
    
}
