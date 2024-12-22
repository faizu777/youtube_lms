<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class course_video extends Model
{
    use HasFactory;
   protected static function booted()
   {
    static::addGlobalScope('videodeleted',function(Builder $builder)
    {
        $builder->where('course_videos.is_deleted',0);
    });
   }
}
