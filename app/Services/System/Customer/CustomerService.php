<?php

namespace App\Services\System\Customer;

use App\Models\Customer;
use App\Services\Service;

class CustomerService extends Service
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('name', 'LIKE',  '%' . $request->keyword . '%');
        }

        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
