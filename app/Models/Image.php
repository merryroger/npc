<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeTotal($query, $show_hidden = true)
    {
        return ($show_hidden) ? $query->get()->count() : $query->where('hidden', $show_hidden)->get()->count();
    }

}
