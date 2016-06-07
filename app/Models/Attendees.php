<?php

# app/Models/Attendees.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Attendees extends Model  
{
	public function scopeBlank($query)
	{
		return $query->where('salted_password', '==', '');
	}
}
