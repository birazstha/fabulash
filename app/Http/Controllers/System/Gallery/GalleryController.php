<?php

namespace App\Http\Controllers\System\Gallery;

use App\Http\Controllers\ResourceController;
use App\Services\System\Gallery\GalleryService;

class GalleryController extends ResourceController
{
    protected $service;

    public function __construct(GalleryService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'galleries';
    }

    public function folderName()
    {
        return 'gallery';
    }
}
