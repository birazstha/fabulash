<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendConfig extends Model
{
    use HasFactory;

    public $timestamps = true;
    public $guarded = ['id'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
