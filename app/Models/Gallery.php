<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'display',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The videos that belong to the gallery.
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video');
    }

}
