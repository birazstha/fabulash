<?php

namespace App\Http\Controllers\System\Enquiry;

use App\Http\Controllers\ResourceController;
use App\Services\System\Enquiry\EnquiryService;

class EnquiryController extends ResourceController
{
    protected $service;

    public function __construct(EnquiryService $service)
    {
        $this->service = $service;
    }

    // public function storeValidationRequest()
    // {
    //     return 'App/http/';
    // }

    public function moduleName()
    {
        return 'enquiries';
    }

    public function folderName()
    {
        return 'enquiry';
    }
}
