<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {
    protected $primaryKey="room_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
    
    public function presentations(){
        return $this->hasMany('App\Models\Presentation');
    }
}