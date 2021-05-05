<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'supplier_id',
        'image',
        'title',
        'slug',
        'description',
        'status',
        'quantity',
        'price',
        'price_cost',
        'sale_price',
        'sku',
    ];

    public function product_images() {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id');
    }

    public function product_categories() {
        return $this->hasMany('App\Models\ProductCategory', 'product_id', 'id');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }

    public function sizes() {
        return $this->hasMany('App\Models\Size', 'product_id', 'id');
    }
}
