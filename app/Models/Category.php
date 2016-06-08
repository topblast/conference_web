<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{
    protected $primaryKey="category_id";

    public function presentations(){
        return $this->belongsToMany('App\Models\Presentation', 'pres_categories');
    }
}
