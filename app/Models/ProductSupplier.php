<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    protected $table = 'product_suppliers';

    protected $fillable = [
        'product_id',
        'supplier_id'
    ];

    public function product() {
        return $this->belongsTo('App\Models\ProductSupplier', 'product_id', 'id');
    }
}
