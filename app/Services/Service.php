<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Service
{
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function query()
    {
        return $this->model->query();
    }

    public function getAllData($request)
    {

        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('title', 'LIKE',  '%' . $request->keyword . '%');
        }

        if (isset($request->id)) {
            $query->where('parent_id', $request->id,);
        }

        return $query->orderBy('updated_at', 'DESC')->get();
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['created_by'] = authUser()->id;
            $this->model->create($data);
        });
    }


    public function update($request, $id)
    {
        $data = $request->except('_token');;
        $update = $this->getItemById($id);
        $update->update($data);
    }

    public function getItemById($id)
    {
        return $this->model->where('id', $id)->first();
    }



    public function indexPageData(Request $request)
    {

        return  [
            'items' => $this->getAllData($request)
        ];
    }

    public function showPageData(Request $request, $id)
    {
        return  [
            'item' => $this->getItemById($id)
        ];
    }

    public function createPageData($request)
    {
        return [
            'status' => $this->status()
        ];
    }

    public function editPageData($id)
    {
        return [
            'item' => $this->getItemById($id),
            'status' => $this->status()
        ];
    }

    public function status()
    {
        return [
            ['value' => 1, 'label' => 'Active'],
            ['value' => 0, 'label' => 'Inactive'],
        ];
    }

    public function delete($request, $id)
    {
        $data = $this->getItemById($id);
        $data->delete();
    }
}