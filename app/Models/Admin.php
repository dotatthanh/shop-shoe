<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    protected $table = 'admins';
    protected $guard_name = 'admin';
    protected $guard = 'admin';

    protected $fillable = [
        'username',
        'avatar',
        'name',
        'email',
        'phone',
        'password',
    ];
}
