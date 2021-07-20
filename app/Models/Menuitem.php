<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\elementType;

class Menuitem extends Model
{
    use HasFactory;

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

    public function scopeValidItems($query, $show_hidden = false)
    {
        $conditions = [['off', '=', 0]];

        if (!$show_hidden) {
            array_unshift($conditions, ['hidden', '=', 0]);
        }

        return $query->where($conditions);
    }

    public function scopeAccessgroup($query, $access_group)
    {
        return $query->where('access_group_id', $access_group)->orderBy('node')->orderBy('level')->orderBy('order');
    }

    public function scopeByLevel($query, $lvl)
    {
        return $query->where('level', $lvl);
    }

    public function scopeByPurpose($query, $purpose)
    {
        return $query->where('purpose', $purpose);
    }

    public function scopeMainCMS($query, $access_group, $purpose = null, $show_hidden = false)
    {
        if (isset($purpose)) {
            $menuset = $query->accessgroup($access_group)->byLevel(0)->byPurpose($purpose)->validItems($show_hidden)->get();
        } else {
            $menuset = $query->accessgroup($access_group)->byLevel(0)->validItems($show_hidden)->get();
        }

        if (!$menuset->count()) {
            return (isset($purpose)) ? [] : ['main' => [], '_tree_' => []];
        }

        if (isset($purpose)) {
            return $menuset->map(function ($item, $key) {
                return collect($item)->except([
                    'order',
                    'purpose',
                    'off',
                    'created_at',
                    'updated_at'
                ])->all();
            })->all();
        } else {
            return $this->reduceMenuSet($menuset);
        }
    }

    public function scopeStructure($query, $access_group, $show_hidden = false)
    {
        $menuset = $query->accessgroup($access_group)->validItems($show_hidden)->get();

        if (!$menuset->count()) {
            return ['main' => [], '_tree_' => []];
        }

        return $this->reduceMenuSet($menuset);

    }

    protected function reduceMenuSet($menuset) {
        return $menuset->reduce(function ($carry, $item) {
            if (!$carry)
                $carry = [];

            $carry[$item->purpose][$item->id] = [
                'id' => $item->id,
                'node' => $item->node,
                'mode' => $item->mode,
                'level' => $item->level,
                'parent' => $item->parent,
                'mnemo' => $item->mnemo,
                'url' => $item->url,
                'behaviour' => $item->behaviour,
                'section_id' => $item->section_id
            ];

            $carry['_tree_'][$item->node][$item->level][$item->mode][$item->parent] = [
                'id' => $item->id,
                'purpose' => $item->purpose
            ];

            return $carry;
        });
    }

    public function scopeHierarchy($query, $access_group, $show_hidden = false, $section_id)
    {
        $items = [];
        $except = ['access_group_id', 'order', 'off', 'created_at', 'updated_at'];

        $menuset = $query->accessgroup($access_group)->validItems($show_hidden)->get();
        $item = $menuset->where('section_id', $section_id)->first();

        while ($item) {
            $items[$item->level] = collect($item->getAttributes())->except($except)->toArray();
            $item = $menuset->where('id', $item->parent)->first();
        }

        ksort($items);

        return $items;
    }

}
