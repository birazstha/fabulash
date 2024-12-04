<?php

namespace App\Http\Controllers\System\Inventory;

use App\Http\Controllers\ResourceController;
use App\Services\System\Inventory\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends ResourceController
{
    public $service;
    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'inventories';
    }

    public function folderName()
    {
        return 'inventory';
    }

    public function addInventory(Request $request)
    {
        dd($request->all());
    }
}
