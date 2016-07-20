<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Speaker Model.
 * 
 * The model for the speakers table.
 * @filesource
 */
class Speaker extends Model {
    protected $primaryKey="speaker_id";

    public function presentations(){
        return $this->belongsToMany('App\Models\Presentation', 'pres_speakers');
    }
    
     public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($speaker)
        {
            if (is_null($speaker->presentations)) {
                //Do nothing
            }
            else
            {
                $speaker->presentations()->detach($speaker->speaker_id);
                //$speaker->presentations()->delete();
            }
            
            
            
           
        });
    }    
}