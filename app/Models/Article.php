<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'subject_id', 'title', 'slug', 'sub_title', 'summary', 'details', 'display', 'image'];

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
    //protected $dates = [ 'created_at', 'deleted_at'];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function($article)
        {
            if (Auth::check()) {
                $article->user_id = Auth::user()->id;
            }
            $article->slug = utf8_slug($article->title);
        });

        static::updating(function ($article)
        {
            $article->slug = utf8_slug($article->title);
        });

    }

    /**
     * Get the user that related with the article.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the subject that related with the article.
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    /**
     * Get all of the tags for the article.
     */
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
     * Get all of the article's comments.
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
