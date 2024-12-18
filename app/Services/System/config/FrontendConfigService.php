<?php

namespace App\Services\System\config;


use App\Models\FrontendConfig;
use App\Services\Service;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendConfigService extends Service
{
    use FileTrait;
    public function __construct(FrontendConfig $config)
    {
        parent::__construct($config);
    }

    public function store($request)
    {
        DB::transaction(function () use ($request) {

            $data = $request->except('_token');
            foreach ($data as $key => $value) {
                $model = $this->model->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            $data['images'] = [
                "header_logo" => $request->cropped_header_logo,
                "footer_logo" => $request->cropped_footer_logo,
            ];


            if ($data['images']) {
                foreach ($data['images'] as $key => $image) {
                    $keyExists = $this->model->where('key', $key)->first();
                    if (!$keyExists) {
                        $model = $this->model->create(
                            ['key' => $key],
                            ['value' => '']
                        );
                        $fileData = [
                            'file' => $image,
                            'model' => $model,
                            'path' => 'uploads/' . $this->getFolderName($request->folder),
                        ];


                        $this->storeBase64Image($fileData);
                    } else {
                        $this->updateImage($image, 'uploads/' . $request->folder, $keyExists);
                    }
                }
            }

            // if ($request->cropped_header_logo) {
            //     $fileData = [
            //         'file' => $request->cropped_header_logo,
            //         'model' => $model,
            //         'path' => 'uploads/' . $this->getFolderName($request->folder),
            //     ];

            //     $this->storeBase64Image($fileData);
            // }

            // if ($request->cropped_footer_logo) {
            //     $fileData = [
            //         'file' => $request->cropped_footer_logo,
            //         'model' => $model,
            //         'path' => 'uploads/' . $this->getFolderName($request->folder),
            //     ];

            //     $this->storeBase64Image($fileData);
            // }
        });
    }



    public function indexPageData(Request $request)
    {
        $data = $this->model->pluck('value', 'key');
        return  [
            'item' => $data
        ];
    }
}
