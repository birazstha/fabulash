<?php

namespace App\Http\Controllers\System\EmailTemplate;

use App\Http\Controllers\ResourceController;
use App\Services\System\EmailTemplate\EmailTemplateService;

class EmailTemplateController extends ResourceController
{
    protected $service;

    public function __construct(EmailTemplateService $service)
    {
        $this->service = $service;
    }

    // public function storeValidationRequest()
    // {
    //     return 'App\Http\Requests\System\ProcessRequest';
    // }


    public function moduleName()
    {
        return 'email-templates';
    }

    public function folderName()
    {
        return 'email-template';
    }
}
