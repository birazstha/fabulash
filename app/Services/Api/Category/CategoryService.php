<?php

namespace App\Services\Api\Category;

use App\Models\Category;
use App\Services\Service;

class CategoryService extends Service
{
    protected $category;
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
