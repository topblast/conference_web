<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;

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


    
    //GET FUNCTIONS
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

    //POST FUNCTIONS
     public function register( Request $request){
        
        $reg = new Attendee;
        $reg->name = $request->input('name');
        $reg->email = $request->input('email');
        $reg->salted_password = $request->input('salted_password');
        
        $reg->save();
        
        return response()->json("New attendee added!");
    }
    

    //CHANGE PASSWORD FUNCTION
    public function change_password($id, Request $request){
        $pEdit = Attendee::find($id);
        
        $pEdit->salted_password = $request->input('salted_password');
        
        $pEdit->save();
        
        return response()->json("Password changed successfully!");
    }
    
    
    //DELETE FUNCTION

    public function delete_attendee($id){
        $del  = Attendee::find($id);
 
        $del->delete();
 
        return response()->json('Attendee has been removed');
    }


        //PUT FUNCTION
    public function edit_attendee(Request $request,$id){
        $edit  = Attendee::find($id);

        $edit->name = $request->input('name');
        $edit->email = $request->input('email');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
