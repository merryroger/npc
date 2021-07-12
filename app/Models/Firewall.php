<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firewall extends Model
{
    use HasFactory;

    public function scopeScan($query)
    {
        $conditions = "(INET_ATON(\"{$_SERVER['REMOTE_ADDR']}\") & ip) = ip";

        $fwlSet = $query->whereRaw($conditions)->where('off', 0)->get();

        if (!$fwlSet->count()) {
            return ['bitmask' => 0x0, 'authtype' => []];
        }

        return $fwlSet->reduce(function($carry, $item) {
            if (!$carry) {
                $carry = [
                    'bitmask' => $item['bitmask'],
                    'authtype' => $item['authtype']
                ];
            } else {
                $carry['bitmask'] &= $item['bitmask'];
                $carry['authtype'] = array_intersect($carry['authtype'], $item['authtype']);
            }

            return $carry;
        });
    }
}
