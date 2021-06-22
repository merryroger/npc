<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    const GUEST_BIP  = 0x1;
    protected $guarded = [];

    public function scopeValid($query, $show_hidden = false)
    {
        $conditions = [['off', '=', 0]];

        if (!$show_hidden) {
            array_unshift($conditions, ['hidden', '=', 0]);
        }

        return $query->where($conditions);
    }

    public function scopeSectionByName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeGuests($query, $show_hidden = false)
    {
        $conditions = 'bip & ' . $this::GUEST_BIP . '>0';

        return $query->valid($show_hidden)->whereRaw($conditions);
    }
}
