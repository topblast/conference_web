<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model{
    public function conferences()
    {
        return $this->hasMany('App\Models\Conference');
    }
}
