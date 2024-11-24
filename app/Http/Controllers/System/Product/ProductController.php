<?php

namespace App\Http\Controllers\System\Product;

use App\Http\Controllers\ResourceController;
use App\Services\System\Product\ProductService;

class ProductController extends ResourceController
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function moduleName()
    {
        return 'products';
    }

    public function folderName()
    {
        return 'product';
    }
}
