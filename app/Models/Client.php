<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable;

class Client extends Model implements JWTSubject, Authenticatable {
    
    use AuthenticatableTrait, Authorizable;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'contact_name',
        'email',
        'password',
        'organisation',
        'address1',
        'address2',
        'city',
        'country',
    ];

    protected $hidden = [
        'password',
    ];

    public function conferences()
    {
        return $this->hasMany('App\Models\Conference');
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }
}
