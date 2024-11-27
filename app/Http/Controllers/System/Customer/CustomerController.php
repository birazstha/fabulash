<?php

namespace App\Http\Controllers\System\Customer;

use App\Http\Controllers\ResourceController;
use App\Services\System\Customer\CustomerService;

class CustomerController extends ResourceController
{
    protected $service;

    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'customers';
    }

    public function folderName()
    {
        return 'customer';
    }
}
