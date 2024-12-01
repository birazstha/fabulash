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
            if (isset($request->galleryId)) {
                $model = $this->getItemById($request->galleryId);
            } else {
                $data['created_by'] = authUser()->id;
                $model = $this->model->create($data);
            }

            foreach ($request->photos as $photo) {
                $fileData = [
                    'model' => $model,
                    'file' => $photo,
                    'path' => 'uploads/gallery'
                ];
                $this->storeBase64Image($fileData);
            }
            return $model->id;
        });
    }
}
