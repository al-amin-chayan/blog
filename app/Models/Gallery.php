<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'display',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The videos that belong to the gallery.
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video');
    }

    /**
     * Get all of the views.
     */
    public function views()
    {
        return $this->morphMany('App\Models\View', 'viewable');
    }
}
