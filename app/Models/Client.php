<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthContract;

class Client extends Model implements AuthContract {
    
    use Authenticatable;

    protected $primaryKey = 'client_id';

    
    public function conferences()
    {
        return $this->hasMany('App\Models\Conference');
    }
}
