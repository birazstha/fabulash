<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\ApiController;
use App\Services\Api\Category\CategoryService;

class CategoryController extends ApiController
{

    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct($categoryService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\Api\CategoryRequest';
    }
}
