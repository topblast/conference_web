<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Presentation model.
 * 
 * The model for the presentations table.
 * @filesource
 */
class Presentation extends Model {
    protected $primaryKey="presentation_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
    
    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'pres_categories');
    }
    
    public function speakers(){
        return $this->belongsToMany('App\Models\Speaker', 'pres_speakers');
    }
    
    public function chats(){
        return $this->hasMany('App\Models\Chatlog');
    }
    
    public function room(){
        return $this->belongsTo('App\Models\Room');
    }
    
    
    public static function boot()
    {
        parent::boot();    
    /*
        static::deleted(function($presentation)
        {
                
            
            if (is_null($presentation->categories)) {
                //Do nothing
            }
            else
            {
                $presentation->categories()->detach($presentation->presentation_id);
                //$presentation->categories()->delete();
            }
            
            
            if (is_null($presentations->speakers)) {
                //Do nothing
            }
            else
            {
                $presentation->speakers()->detach($presentation->speakers()->speaker_id);

               // $presentations->speakers()->delete();
            }
            
            
           
        });
     
        
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($presentation)
        {
            if (is_null($presentation->chats)) {
                //Do nothing
            }
            else
            {
                $presentation->chats()->delete();
            }
            
            
            
            if (is_null($presentation->categories)) {
                //Do nothing
            }
            else
            {
                $presentation->categories()->detach($presentation->presentation_id);
                //$presentation->categories()->delete();
            }
            
            
            if (is_null($presentations->speakers)) {
                //Do nothing
            }
            else
            {
                $presentation->speakers()->detach($presentation->speakers()->speaker_id);

               // $presentations->speakers()->delete();
            }
            
            
           
        });
     
     */
    }    
}