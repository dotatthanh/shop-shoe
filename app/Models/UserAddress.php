<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',
        'phone',
        'name',
        // 'city',
        // 'district',
        'address',
        'default_address',
        'status'
    ];

    public function user() {
        return $this->belongsTo('\App\Models\User');
    }
}
