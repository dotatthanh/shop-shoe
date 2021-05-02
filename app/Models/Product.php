<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'specification',
        'tags',
        'status',
        'is_hot',
        'quantity',
        'price',
        'price_cost',
        'sale_price',
    ];

    public function product_images() {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }

    public function product_categories() {
        return $this->hasMany('App\Models\ProductCategory', 'product_id', 'id');
    }

    public function product_suppliers() {
        return $this->hasMany('App\Models\ProductSupplier', 'product_id', 'id');
    }

    public function suppliers() {
        return $this->belongsToMany('\App\Models\Supplier', 'product_suppliers', 'product_id', 'supplier_id');
    }
}
