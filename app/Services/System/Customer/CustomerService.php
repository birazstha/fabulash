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
}
