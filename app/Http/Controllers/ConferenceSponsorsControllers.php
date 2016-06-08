<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientsController extends Controller
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

        $cli = Client::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_conference_sponsor($id){
        $del  = Client::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }


}
