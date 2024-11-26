<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Order extends Model
{
    use HasFactory, LogsActivity;
    public $timestamps = true;

    public $guarded = ['id'];

    protected static $logName = 'Order';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName)
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
