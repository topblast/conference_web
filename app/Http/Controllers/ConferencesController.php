<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ConferencesController extends Controller
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

        $all = Conference::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Conference::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_conference($id){
        $del  = Conference::find($id);
 
        $del->delete();
 
        return response()->json('Conference has been removed');
    }


    //THIS NEEDS TO BE EDITED
    public function edit_conference(Request $request,$id){
        $edit  = Conference::find($id);

		$edit->name = $request->input('name');
		$edit->type = $request->input('type');
		$edit->address1 = $request->input('address1');
		$edit->address2 = $request->input('address2');
		$edit->city = $request->input('city');
		$edit->country = $request->input('country');
		$edit->start = $request->input('start');
		$edit->end = $request->input('end');

		
 
        $edit->save();
  
        return response()->json($edit);
    }


}
