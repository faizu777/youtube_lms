<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class course extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope('excludeDeleted', function (Builder $builder) {
            $builder->where('is_deleted', 0);
        });
    }
}
