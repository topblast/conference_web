<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model {
    protected $primaryKey="speaker_id";

    public function presentations(){
        return $this->belongsToMany('App\Models\Presentation', 'pres_speakers');
    }
}