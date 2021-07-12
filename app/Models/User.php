<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public function scopeValid($query)
    {
        return $query->where('status', 'valid')->where('locked_till', '<', now());
    }

    public function scopeByCheckHash($query, $hash, $token)
    {
        $conditions = "MD5(CONCAT('{$token}', checkhash)) = '{$hash}'";

        return $query->whereRaw($conditions);
    }

    public function scopeApplyFirewall($query, $bitmask)
    {
        $conditions = "(bip & {$bitmask}) > 0";

        return $query->whereRaw($conditions);
    }

}
