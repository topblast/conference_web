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
        
        return Attendee::all();
    }


    public function get_id($id) {

        $cli = Attendee::find($id);
        
       //  $cli = Attendee::query()->findOrFail($id);
       // return response()->json($cli);
        return view('test', ['attendee' => $cli]); 
    }

    //PUT FUNCTION

    public function delete_attendee($id){
        $del  = Attendee::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }

    public function edit_attendee($id){
        $edit  = Attendee::find($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');
 
        $article->save();
  
        return response()->json($edit);
    }


}
