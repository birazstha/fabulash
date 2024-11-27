<?php

namespace App\Services\System\Gallery;

use App\Models\Gallery;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class GalleryService extends Service
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }

    public function store($request)
    {

        return DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['created_by'] = authUser()->id;
            $model = $this->model->create($data);
            if ($request->photos) {
                foreach ($request->photos as $photo) {
                    $this->storeImage($photo, 'uploads/gallery', $model);
                }
            }
            return $model->id;
        });
    }
}
