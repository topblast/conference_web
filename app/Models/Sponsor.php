<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The Sponsor Model.
 * 
 * The model for the sponsors table.
 * @filesource
 */
class Sponsor extends Model {
    protected $primaryKey="sponsor_id";

    public function conference(){
        return $this->belongsTo('App\Models\Conference');
    }
}