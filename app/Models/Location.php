<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function scopeLocationDirById($query, $locId)
    {
        $location = $query->where('id', $locId)->get()->map(function($item, $key) {
           return $item->only('rel_path');
        })->first()['rel_path'];

        return $location;
    }

}
