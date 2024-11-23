<?php

use App\Models\Role;

function checkPermission($path, $method)
{
    $permissionArray = [];

    $new = [
        'url' => $path,
        'method' => $method
    ];

    $roleId = authUser()->role_id;

    if ($roleId != 1) {
        $role = Role::find($roleId);
        foreach ($role->permissions as $permission) {
            array_push($permissionArray, [
                'url' => $permission->url,
                'method' => $permission->method
            ]);
        }
        if (in_array($new, $permissionArray)) {
            return true;
        } else {
            return false;
        }
    }
    return true;
}

function permissions()
{
    return [
        'index' => 'List',
        'create' => 'Create',
        'show' => 'View',
        'edit' => 'Edit',
        'destroy' => 'Delete',
    ];
}
