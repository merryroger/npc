<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function locations()
    {
        return $this->belongsTo(Location::class);
    }

    public function scopeTotal($query, $show_hidden = true)
    {
        return ($show_hidden) ? $query->get()->count() : $query->where('hidden', true)->get()->count();
    }

    public function scopeDataSet($query, $show_hidden = true)
    {
        $rq = ($show_hidden) ? $query : $query->where('hidden', true);

        return $rq->orderByDesc('id')->orderBy('pack_id');
    }

}
