<?php

namespace App\Services\System\Category;

use App\Models\Category;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class SubCategoryService extends Service
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
        return $query->where('parent_id', $request->category)->orderBy('updated_at', 'DESC')->get();
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['parent_id'] = $request->category;
            $data['created_by'] = authUser()->id;
            $this->model->create($data);
        });
    }

    public function editPageData($id)
    {
        return [
            'item' => $this->getItemById($id),
            'status' => $this->status()
        ];
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');;
        $update = $this->getItemById($request->sub_category);
        $update->update($data);
    }

    public function delete($request, $id)
    {
        $data = $this->getItemById($request->sub_category);
        $data->delete();
    }
}
