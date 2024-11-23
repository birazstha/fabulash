<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    public $timestamps = true;
    public $guarded = ['id'];

    public $table = "activity_log";

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
