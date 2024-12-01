<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Enquiry extends Model
{
    public $timestamps = true;
    public $guarded = ['id'];
}
