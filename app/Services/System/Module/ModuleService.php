<?php

namespace App\Services\System\Module;

use App\Models\Module;
use App\Models\Permission;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleService extends Service
{
    protected $model, $installment, $permission;
    public function __construct(Module $model, Permission $permission)
    {
        parent::__construct($model);
        $this->permission = $permission;
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $module = $this->model->create($data);
            $permissionArray = [];
            foreach ($request->permissions as $key => $permission) {
                array_push($permissionArray, [
                    'module_id' => $module->id,
                    'name' => $this->getName($request->route, $permission),
                    'route' => $request->route . '.' . $permission,
                ]);
            };

            if (in_array('create', $request->permissions)) {
                array_push($permissionArray, [
                    'module_id' => $module->id,
                    'name' => 'Store ' . Str::ucfirst($request->route),
                    'route' => $request->route . '.store'
                ]);
            }
            if (in_array('edit', $request->permissions)) {
                array_push($permissionArray, [
                    'module_id' => $module->id,
                    'name' => 'Update ' . Str::ucfirst($request->route),
                    'route' => $request->route . '.update'
                ]);
            }
            $this->permission->insert($permissionArray);
        });
    }

    public function getName($route, $permission)
    {
        if ($permission === 'index') {
            return 'List ' . ' ' . Str::ucfirst($route);
        } elseif ($permission === 'destroy') {
            return 'Delete ' . ' ' . Str::ucfirst($route);
        } else {
        }
        return Str::ucfirst($permission) . ' ' . Str::ucfirst($route);
    }
}
