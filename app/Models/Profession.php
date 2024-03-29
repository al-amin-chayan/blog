<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * Get the users for the user type.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function articles()
    {
        return $this->hasManyThrough('App\Models\Article', 'App\Models\User');
    }
    
    /**
     * Get all of the views.
     */
    public function views()
    {
        return $this->morphMany('App\Models\View', 'viewable');
    }
}
