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
        $query = $query->whereNull('deleted_at');

        if ($include_hidden) {
            return $query->count();
        } else {
            return $query->where('hidden', 0)->count();
        }
    }

    public function scopeNewsItem($query, $id, $show_hidden = false)
    {
        $query = $query->whereNull('deleted_at');

        if (!$show_hidden) {
            $query = $query->where('hidden', 0);
        }

        return $query->whereId($id)->first();
    }

    public function scopeNewsList($query, $count, $order, $include_hidden = false)
    {
        $query = $query->whereNull('deleted_at');

        if (!$include_hidden) {
            $query = $query->where('hidden', 0);
        }

        return $query->orderBy('official_news_date', $order)->skip(0)->take($count);
    }

    public function scopeMaxNewsItemByOfficialDate($query, $include_hidden = false)
    {
        $query = $query->whereNull('deleted_at');

        if (!$include_hidden) {
            $query = $query->where('hidden', 0);
        }

        return $query->orderBy('official_news_date', 'desc')->first();
    }
}
