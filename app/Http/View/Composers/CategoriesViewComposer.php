<?php

namespace App\Http\View\Composers;

use App\Services\System\Category\CategoryService;
use Illuminate\View\View;

class CategoriesViewComposer
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose(View $view)
    {
        $data = [
            'categories' => $this->categoryService->getAllData(request())->pluck('title', 'id')
        ];
        $view->with($data);
    }
}
