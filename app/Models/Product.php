<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    use HasFactory, LogsActivity;
    public $timestamps = true;

    public $guarded = ['id'];

    protected static $logName = 'Product';

    protected $casts = [
        'diameter' => 'json',
        'curl' => 'json',
        'length' => 'json',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName)
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
