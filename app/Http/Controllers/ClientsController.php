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


    public function get_all() {
        
        return Client::all();
    }

    //check this one
    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }


}
