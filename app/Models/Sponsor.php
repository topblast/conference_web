<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {
    protected $primaryKey="sponsor_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
}