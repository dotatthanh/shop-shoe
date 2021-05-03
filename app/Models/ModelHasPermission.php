<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHasPermission extends Model
{
    protected $fillable = [
        "permission_id",
        "model_id"
    ];
    protected $table = 'model_has_permissions';
}
