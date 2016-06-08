<?php

namespace App\Http\Controllers;

use App\Models\Presentation;

class SpeakerPresentationController extends Controller
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

        $cli = Presentation::find($id);

        return response()->json($cli);
    }


}
