<?php

namespace App\Http\Controllers\System\Testimonial;

use App\Http\Controllers\ResourceController;
use App\Services\System\Testimonial\TestimonialService;

class TestimonialController extends ResourceController
{
    protected $service;

    public function __construct(TestimonialService $service)
    {
        $this->service = $service;
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\TestimonialRequest';
    }

    public function moduleName()
    {
        return 'testimonials';
    }

    public function folderName()
    {
        return 'testimonial';
    }
}
