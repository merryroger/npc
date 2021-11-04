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

    public function scopeTotal($query, $show_hidden = true)
    {
        return ($show_hidden) ? $query->get()->count() : $query->where('hidden', true)->get()->count();
    }

    public function scopeDataSet($query, $show_hidden = true)
    {
        $rq = ($show_hidden) ? $query : $query->where('hidden', false);

        return $rq->orderByDesc('id');
    }

    public function scopeLocationDirById($query, $locId)
    {
        $location = $query->where('id', $locId)->get()->map(function ($item, $key) {
            return $item->only('rel_path');
        })->first()['rel_path'];

        return $location;
    }

    public function scopeFindMatches($query, $fields, $scheme = 'OR')
    {
        if (gettype($fields) == 'array') {
            foreach ($fields as $fieldName => $fieldValue) {
                $conds[] = (is_numeric($fieldValue)) ? "{$fieldName}={$fieldValue}" : "{$fieldName}='{$fieldValue}'";
            }

            $conditions = (count($conds) > 1) ? '(' . join(" {$scheme} ", $conds) . ')' : $conds[0];
        } elseif (gettype($fields) == 'string') {
            $conditions = $fields;
        } else {
            return null;
        }

        return $query->whereRaw($conditions);
    }

}
