<?php

namespace App\Services\System\File;

use App\Models\File;
use App\Services\Service;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class FileService extends Service
{
    use FileTrait;

    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($id, $request) {
            $data = $request->except('_token');
            $update = $this->getItemById($id);
            $data['updated_by'] = authUser()->id;
            $update->update($data);


            $fileData = [
                'file' => $request->cropped_image,
                'model' => $update,
                'file_title' => 'test'
            ];
            $this->updateBase64Image($fileData);

            return $update;
        });
    }

    public function delete($moduleName = null, $id)
    {
        DB::transaction(function () use ($id) {
            $data = $this->getItemById($id);
            if (FacadesFile::exists($data['path'])) {
                FacadesFile::delete($data['path']);
            }
            $data->delete();
        });
    }
}
