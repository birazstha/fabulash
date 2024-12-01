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
        dd($request->all());

        DB::transaction(function () use ($request) {
            foreach ($request->except('_token', 'file') as $key => $value) {
                $this->model->updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            if ($request->file) {
                foreach ($request->file as $key => $file) {
                    $keyExists = $this->model->where('key', $key)->first();
                    if (!$keyExists) {
                        $model = $this->model->create(
                            ['key' => $key],
                            ['value' => '']
                        );
                        $this->storeImage($file, 'uploads/' . $request->folder, $model);
                    } else {
                        $this->updateImage($file, 'uploads/' . $request->folder, $keyExists);
                    }
                }
            }
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
