<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model{
    protected $primaryKey="conference_id";

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }
    
    public function presentations()
    {
        return $this->hasMany('App\Models\Presentation');
    }
    
    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }
    
    public function sponsors()
    {
        return $this->hasMany('App\Models\Sponsor');
    }
    
    public function whitelist()
    {
        return $this->hasMany('App\Models\Whitelist');
    }
    
    public function blacklist()
    {
        return $this->hasMany('App\Models\Blacklist');
    }
    
    public function attendees(){
        return $this->belongsToMany('App\Models\Attendee', 'conference_attendees');
    }
    
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
