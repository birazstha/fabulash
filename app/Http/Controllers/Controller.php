<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as ResourceController;

class Controller extends ResourceController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
