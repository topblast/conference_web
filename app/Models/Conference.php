<?php
/**
 * Conference.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Conference Model.
 * 
 * The model for the conferences table
 * @filesource
 */
class Conference extends Model{
    protected $primaryKey="conference_id";
    /**
     * Establishes many-to-one relationship with clients table
     * @return type
     */
    public function client() {
        return $this->belongsTo('App\Models\Client');
    }
    
    /**
     * Establishes one-to-many relationship with presentations table 
     * @return type
     */
    public function presentations()
    {
        return $this->hasMany('App\Models\Presentation');
    }
    
    /**
     * Establishes one-to-many relationship with rooms table
     * @return type
     */
    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }
    
    /**
     * Establishes one-to-many relationship with sponsors table
     * @return type
     */
    public function sponsors()
    {
        return $this->hasMany('App\Models\Sponsor');
    }
    
    /**
     * Establishes one-to-many relationship with whitelists table
     * @return type
     */
    public function whitelist()
    {
        return $this->hasMany('App\Models\Whitelist');
    }
    
    /**
     * Establishes one-to-many relationship with blacklists table
     * @return type
     */
    public function blacklist()
    {
        return $this->hasMany('App\Models\Blacklist');
    }
    
    /**
     * Establishes many-to-many relationship with attendees table
     * @return type
     */
    public function attendees(){
        return $this->belongsToMany('App\Models\Attendee', 'conference_attendees');
    }
    
    /**
     * Event for when model is booted
     */
     public static function boot()
    {
        parent::boot();    
    
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleting(function($conference)
        {
            
            
            
            
            if (is_null($conference->presentations)) {
                //Do nothing
            }
            else
            {
                $conference->presentations()->delete();
            }
            
            
            
           
            
            
            if (is_null($conference->sponsors)) {
                //Do nothing
            }
            else
            {
                $conference->sponsors()->delete();
            }
            
            
            if (is_null($conference->whitelist)) {
                //Do nothing
            }
            else
            {
                $conference->whitelist()->delete();
            }
            
            
            if (is_null($conference->blacklist)) {
                //Do nothing
            }
            else
            {
                $conference->blacklist()->delete();
            }
            
             if (is_null($conference->rooms)) {
                //Do nothing
            }
            else
            {
                $conference->rooms()->delete();
            }
        });
    }    
}
