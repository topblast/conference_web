<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chatlog extends Model{
    
    public function room(){
        return $this->belongsTo('App\Models\Room');
    }
    
    public function attendee(){
        return $this->belongsTo('App\Models\Attendee');
    }
}
