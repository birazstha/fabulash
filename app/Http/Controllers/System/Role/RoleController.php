<?php

namespace App\Http\Controllers\System\Role;

use App\Http\Controllers\ResourceController;
use App\Services\System\role\RoleService;
use Illuminate\Http\Request;

class RoleController extends ResourceController
{
    protected $service;

    public function __construct(RoleService $service)
    {
        parent::__construct($service);
    }

    // public function storeValidationRequest()
    // {
    //     return 'App\Http\Requests\System\UserRequest';
    // }

    public function moduleName()
    {
        return 'roles';
    }

    public function folderName()
    {
        return 'role';
    }

    public function givePermission(Request $request)
    {
        return $this->service->givePermission();
    }

    public function update(Request $request, $id)
    {
        $this->service->update($request, $id);
        $this->toastMessage('update');
        return redirect()->back();
    }
}
