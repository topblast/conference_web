<?php

namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Http\Request;


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


    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }

    

    public function delete_client($id){
        $del  = Client::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }

    //PUT FUNCTION
    public function edit_client($id, Request $request){
        $edit  = Client::find($id);

        $edit->contact_name = $request->input('contact_name');
        $edit->email = $request->input('email');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
