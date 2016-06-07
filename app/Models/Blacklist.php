<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model{
    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
    
    public function attendee(){
        return $this->belongsTo('App\Models\Attendee');
    }
}
