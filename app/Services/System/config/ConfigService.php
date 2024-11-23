<?php

namespace App\Services\System\Config;

use App\Models\Config;
use App\Services\Service;

class ConfigService extends Service
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('label', 'LIKE',  '%' . $request->keyword . '%');
        }
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');

        if ($request->file('value')) {
            $file = $request->file('value');
            $file->move(public_path('uploads/config'), 'cms_logo.png');
            $data['value'] = 'cms_logo.png';
        }

        $update = $this->getItemById($id);
        $update->fill($data)->save();
    }
}
