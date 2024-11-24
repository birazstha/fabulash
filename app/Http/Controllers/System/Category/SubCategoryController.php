<?php

namespace App\Http\Controllers\System\Category;

use App\Http\Controllers\ResourceController;
use App\Services\System\Category\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends ResourceController
{
    protected $categoryService;

    public function __construct(SubCategoryService $categoryService)
    {
        parent::__construct($categoryService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\System\SubCategoryRequest';
    }

    public function isSubModule()
    {
        return true;
    }

    public function moduleName()
    {
        return 'categories';
    }

    public function subModuleName()
    {
        return 'sub-categories';
    }

    public function folderName()
    {
        return 'sub-category';
    }

    public function getSubCategory(Request $request)
    {
        return $this->service->getSubCategory($request);
    }
}
