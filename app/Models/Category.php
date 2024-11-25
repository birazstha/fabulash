<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model
{
    use HasFactory, LogsActivity;
    public $timestamps = true;

    public $guarded = ['id'];

    protected static $logName = 'Category';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName)
            ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }

    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
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
