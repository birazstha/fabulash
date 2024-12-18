<?php

namespace App\Services\System\Category;

use App\Models\Category;
use App\Services\Service;

class CategoryService extends Service
{
    protected $category;
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('title', 'LIKE',  '%' . $request->keyword . '%');
        }
        $query->whereNull('parent_id');
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function getCategoryBySlug($slug)
    {
        return $this->model->where('slug',$slug)->value('id');
    }
}
