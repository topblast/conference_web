<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Room model.
 * 
 * The model for the rooms table.
 * @filesource
 */
class Room extends Model {
    protected $primaryKey="room_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
    
    public function presentations(){
        return $this->hasMany('App\Models\Presentation');
    }
    
    
     public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($room)
        {
            if (is_null($room->presentations)) {
                //Do nothing
            }
            else
            {
                $room->presentations()->delete();
                //$speaker->presentations()->delete();
            }
            
            
            
           
        });
    }    
    
}