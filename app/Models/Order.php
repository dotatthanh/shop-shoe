<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'code',
        'fee_ship',
        'total',
        'status',
    ];

    public function order_address() {
        return $this->belongsTo('App\Models\OrderAddress', 'id', 'order_id');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'order_products', 'order_id', 'product_id');
    }

    public function order_products() {
        return $this->hasMany('App\Models\OrderProduct', 'order_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
