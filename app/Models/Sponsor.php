<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {
    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
}