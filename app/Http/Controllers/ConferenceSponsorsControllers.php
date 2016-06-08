<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;

class ConferenceSponsorsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function get_id($id) {

        $cli = ConferenceSponsors::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_conference_sponsor($id){
        $del  = CoferenceSponsors::find($id);
 
        $del->delete();
 
        return response()->json('Conference sponsor has been removed');
    }


}
