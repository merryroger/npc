<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    const GUEST_BIP  = 0x1;
    protected $guarded = [];

    public function menuItems()
    {
        return $this->hasMany(Menuitem::class);
    }

    public function validMenuItems($show_hidden = false)
    {
        $conditions = [['off', '=', 0]];

        if (!$show_hidden) {
            array_unshift($conditions, ['hidden', '=', 0]);
        }

        return $this->menuItems()->where($conditions);
    }

    public function retrieveAccessGroup($use_hidden = false)
    {
        if ($this->validMenuItems($use_hidden)->count())
            return $this->validMenuItems($use_hidden)->groupBy('access_group_id')->value('access_group_id');

        return -1;
    }

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

    public function getTemplateAttribute()
    {
        return $this->getAttributes()['template'];
    }

    public function getEntrypointAttribute()
    {
        return $this->getAttributes()['entry_point'];
    }

    public function getViewAttribute()
    {
        return $this->getAttributes()['gen_view'];
    }
}
