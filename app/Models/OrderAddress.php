<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $table = 'order_adddresses';

    protected $fillable = [
        'order_id',
        'name',
        'email',
        'phone',
        'address',
    ];
}
