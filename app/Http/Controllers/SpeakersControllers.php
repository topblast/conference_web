<?php

namespace App\Http\Controllers;

use App\Models\Speaker;

class SpeakersController extends Controller
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

        $cli = Speakers::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION


}
