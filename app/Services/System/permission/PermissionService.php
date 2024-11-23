<?php

namespace App\Services\System\Permission;

use App\Models\Module;
use App\Models\Permission;
use App\Services\Service;

class PermissionService extends Service
{
    protected $module;
    public function __construct(Permission $model, Module $module)
    {
        parent::__construct($model);
        $this->module = $module;
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('title', 'LIKE',  '%' . $request->keyword . '%');
        }

        if (isset($request->moduleId)) {
            $query->where('module_id', $request->moduleId);
        }

        return $query->with('modules')->orderBy('updated_at', 'DESC')->get();
    }

    public function createPageData($request)
    {
        return [
            'modules' => $this->module->pluck('name', 'id'),
            'status' => $this->status()
        ];
    }

    public function editPageData($id)
    {
        return [
            'modules' => $this->module->pluck('name', 'id'),
            'item' => $this->getItemById($id),
            'status' => $this->status()
        ];
    }
}
