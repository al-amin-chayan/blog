<?php

namespace App\Models;

//use App\Models\Profile;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'profession_id', 'name', 'email', 'password','remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Set the password to be hashed when saved
     *
     * @param  string $password
     *
     * @return void
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    /**
     * Check the administrative privilege of the user.
     */
    public function isAdministrator()
    {
        return $this->id === 1 ? true : false;
    }
    
    /**
     * Get the profile record associated with the user.
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    /**
     * Get the type of the user.
     */
    public function profession()
    {
        return $this->belongsTo('App\Models\Profession');
    }
    
    /**
     * Get the type of the user.
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
    
    /**
     * Get the type of the user.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    /**
     * Get all of the views.
     */
    public function views()
    {
        return $this->morphMany('App\Models\View', 'viewable');
    }
}
