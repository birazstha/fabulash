<?php

namespace App\Services\System\Enquiry;


use App\Models\Enquiry;
use App\Services\Service;

class EnquiryService extends Service
{
    public function __construct(Enquiry $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {
        $query = $this->query();
        if (isset($request->keyword)) {
            $query->where('name', 'LIKE',  '%' . $request->keyworsd . '%');
        }
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
