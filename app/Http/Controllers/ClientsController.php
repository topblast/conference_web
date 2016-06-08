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

        $all = Client::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_client($id){
        $del  = Client::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }


    //THIS NEEDS TO BE EDITED
    public function edit_client(Request $request,$id){
        $edit  = Client::find($id);
		
		$edit->name = $request->input('name');
		$edit->type = $request->input('type');
		$edit->address1 = $request->input('address1');
		$edit->address2 = $request->input('address2');
		$edit->city = $request->input('city');
		$edit->country = $request->input('country');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
