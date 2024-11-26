<?php

namespace App\Services\System\Testimonial;

use App\Models\Testimonial;
use App\Services\Service;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;

class TestimonialService extends Service
{
    use FileTrait;
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function getAllData($request)
    {
        $query = $this->query()->rank();
        if (isset($request->keyword)) {
            $query->where('name', 'LIKE',  '%' . $request->keyword . '%');
        }
        return $query->orderBy('updated_at', 'DESC')->paginate(PAGINATE);
    }
}
