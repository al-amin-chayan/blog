<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'view_count'
    ];
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];
    
    /**
     * Get all of the owning viewable models.
     */
    public function viewable()
    {
        return $this->morphTo();
    }
}
