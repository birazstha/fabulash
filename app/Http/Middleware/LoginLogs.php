<?php

namespace App\Http\Middleware;

use App\Models\System\LoginLog;
use Closure;
use Illuminate\Support\Facades\Auth;

class LoginLogs
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::guard('web')->check()) {
            Auth::shouldUse('web');
        } else {
            return $next($request);
        }
        $user = auth()->user();
        $this->createLoginLog($user, $request);
        return $response;
    }


    public function createLoginLog($user, $request)
    {
        $currentIp = '2404:7c00:41:e86d:2c7e:97ac:e95a:2952';
        $macAddress = $request->header('X-Device-MAC'); // Assuming MAC address is in a custom header

        $ip = file_get_contents('http://ip-api.com/php/' . $currentIp);
        $locationData = unserialize($ip);

        $data = [
            'user_id' => $user->id,
            'mac_address' => $macAddress,
            'ip_address' => $currentIp,
            'location' => [
                'country' => $locationData['country'] ?? null,
                "province" => $locationData['regionName'] ?? null,
                "city" => $locationData['city'] ?? null,
            ],
            "coordinates" => $locationData['lat'] . ',' . $locationData['lon'],
            "isp" => $locationData['isp'] ?? null,
        ];
        LoginLog::create($data);
    }
}
