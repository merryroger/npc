<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeTotal($query)
    {
        return $query->get()->count();
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
