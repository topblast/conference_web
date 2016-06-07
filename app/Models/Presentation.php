<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model {
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
}