<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FrontendAuth
{


    public function handle($request, Closure $next)
    {
        if (!Auth::guard('frontendUser')->check()) {
            return response()->json([
                'errors' => [
                    'message' => 'Unauthenticated'
                ]
            ], 401);
        }
        $request = $this->addUserToRequest($request);

        return $next($request);
    }

    private function addUserToRequest($request)
    {
        $user = Auth::guard('frontendUser')->user();
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        Auth::setUser($user);

        return $request;
    }
}
