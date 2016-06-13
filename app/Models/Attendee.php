<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthContract;

class Attendee extends Model implements AuthContract{
    use Authenticatable;

    protected $primaryKey = 'attendee_id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    public function conferences(){
        return $this->belongsToMany('App\Models\Conference', 'conference_attendees');
    }
    
    public function chats()
    {
        return $this->hasMany('App\Models\Chatlog');
    }
    
    public function whitelist()
    {
        return $this->hasMany('App\Models\Whitelist');
    }
    
    public function blacklist()
    {
        return $this->hasMany('App\Models\Blacklist');
    }
}
