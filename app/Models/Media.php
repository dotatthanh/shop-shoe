<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'title',
        'type',
        'url',
        'thumbnail',
        'caption',
        'place_storage',
        'size',
        'status',
    ];

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSizeInKbAttribute()
    {
        return round($this->size / 1024, 2);
    }

    public function scopePublic($query)
    {
        return $query->where('medias.status', 'public');
    }

    public function scopeDelete($query)
    {
        return $query->where('medias.status', 'delete');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
