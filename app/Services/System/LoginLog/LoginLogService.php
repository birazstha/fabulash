<?php

namespace App\Services\System\LoginLog;

use App\Models\LoginLog;
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;

class LoginLogService extends Service
{
    public function __construct(LoginLog $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->user_id)) {
            $query->where('user_id', $request->user_id);
        }
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function indexPageData(Request $request)
    {
        return  [
            'items' => $this->getAllData($request),
            'users' => User::pluck('name', 'id')
        ];
    }
}
