<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    public function presentations(){
        return $this->belongsToMany('App\Models\Presentation', 'pres_categories');
    }
}
