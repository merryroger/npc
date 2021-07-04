<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeNewsCount($query, $include_hidden = false)
    {
        if ($include_hidden) {
            return $query->count();
        } else {
            return $query->where('hidden', 0)->count();
        }
    }
}
