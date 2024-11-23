<?php

namespace App\Services\System\EmailTemplate;

use App\Models\EmailTemplate;
use App\Services\Service;

class EmailTemplateService extends Service
{
    public function __construct(EmailTemplate $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {

        $query = $this->query();

        if (isset($request->keyword)) {
            $query->where('code', 'LIKE',  '%' . $request->keyword . '%');
        }

        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
