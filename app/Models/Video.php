<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider', 'title', 'summary', 'source', 'display'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The galleries that belong to the video.
     */
    public function galleries()
    {
        return $this->belongsToMany('App\Models\Gallery');
    }


    /**
     * Get all of the tags for the video.
     */
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
    
    /**
     * Get all of the video's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
    
    /**
     * Get all of the views.
     */
    public function views()
    {
        return $this->morphMany('App\Models\View', 'viewable');
    }
}
