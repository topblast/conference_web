<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model{
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
}
