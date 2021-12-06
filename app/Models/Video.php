<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function scopeUndeleted($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeValid($query, $include_hidden = false)
    {
        $query = $this->scopeUndeleted($query);

        return ($include_hidden) ? $query : $query->where('hidden', 0);
    }

    public function scopeVideosCount($query, $include_hidden = false)
    {
        $query = $this->scopeUndeleted($query);

        return ($include_hidden) ? $query->count() : $query->where('hidden', 0)->count();
    }

}
