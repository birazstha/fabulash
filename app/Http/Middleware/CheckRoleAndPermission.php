<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRoleAndPermission
{
    protected $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function handle(Request $request, Closure $next)
    {
        $roleId = authUser()->role_id;
        if ($roleId != 1) {
            $method = $request->method();

            $seg1 = request()->segment(2);
            $seg2 = request()->segment(3);
            $seg3 = request()->segment(4);
            $url = urlFormatter($seg1, $seg2, $seg3);

            $hasPermission = $this->check($url, $method);


            if ($hasPermission) {
                return $next($request);
            } else {
                return response()->view('error.403');
            }
        }

        return $next($request);
    }

    public function check($url, $method)
    {
        // dd($url,$method);
        $segment2 = (request()->segment(3));
        if ($method == 'POST' && !$segment2) {
            return checkPermission($url . '/create', 'GET');
        } else if ($method == 'PUT') {
            return checkPermission($url . '/edit', 'GET');
        } else {

            return checkPermission($url, $method);
        }
    }
}
