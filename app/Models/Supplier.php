<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'title',
        'slug',
        'avatar',
        'email',
        'address',
        'phone',
    ];
}
