<?php
/**
 * Attendee.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * Attendee model.
 * 
 * The Attendee model for the attendees table.
 * 
 * @filesource
 */
class Attendee extends Model implements CanResetPasswordContract, JWTSubject, Authenticatable{
    use CanResetPassword, AuthenticatableTrait, Authorizable;

    protected $primaryKey = 'attendee_id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    /**
     * Establishes a many-to-many relationship with conferences table
     * @return type
     */
    public function conferences(){
        return $this->belongsToMany('App\Models\Conference', 'conference_attendees');
    }
    
    /**
     * Establishes a one-to-many relationship with chatlogs table
     * @return type
     */
    public function chats()
    {
        return $this->hasMany('App\Models\Chatlog');
    }
    
    /**
     * Establishes a one-to-many relationship with whitelists table
     * @return type
     */
    public function whitelist()
    {
        return $this->hasMany('App\Models\Whitelist');
    }
    
    /**
     * Establishes a one-to-many relationship with blacklists table
     * @return type
     */
    public function blacklist()
    {
        return $this->hasMany('App\Models\Blacklist');
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
    
    public function getRememberToken()
    {   
    return $this->remember_token;
    }

    public function setRememberToken($value)
    {
    $this->remember_token = $value;
    }   

    public function getRememberTokenName()
    {
    return 'remember_token';
    }
}
