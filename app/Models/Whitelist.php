<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model {
    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
}