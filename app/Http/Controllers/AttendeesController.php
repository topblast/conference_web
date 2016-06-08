<?php

namespace App\Http\Controllers;

use App\Models\Attendee;

class AttendeesController extends Controller
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

        $all = Attendee::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Attendee::find($id);
        
        // $cli = Attendee::query()->findOrFail($id);
        return response()->json($cli);
        //return view('test', ['attendee' => $cli]); 
    }

    //PUT FUNCTION

    public function delete_attendee($id){
        $del  = Attendee::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }


        //THIS NEEDS TO BE EDITED
    public function edit_attendee(Request $request,$id){
        $edit  = Attendee::find($id);

        $edit->title = $request->input('title');
        $edit->content = $request->input('content');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
