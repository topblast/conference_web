<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model{
    protected $primaryKey ='attendee_id';
    
    public function conferences(){
        return $this->belongsToMany('App\Models\Conference', 'conference_attendees');
    }
    
    public function chats()
    {
        return $this->hasMany('App\Models\Chatlog');
    }
    
    public function whitelist()
    {
        return $this->hasMany('App\Models\Whitelist');
    }
    
    public function blacklist()
    {
        return $this->hasMany('App\Models\Blacklist');
    }
}
