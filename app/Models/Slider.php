<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Slider extends Model
{
    use HasFactory, LogsActivity;

    public $timestamps = true;
    public $guarded = ['id'];
    protected static $logName = 'Slider';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName)
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeRank($query)
    {
        return $query->orderBy('rank', 'ASC');
    }
}
