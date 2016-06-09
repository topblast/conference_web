<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Presentation;
use App\Models\Sponsor;

use Illuminate\Http\Request;


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

    //GET FUNCTIONS
    public function get_all() {
        //Get all PUBLIC Conferences
        $all = Conference::all()->where('type', 'public');
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Conference::find($id);

        return response()->json($cli);
    }
    
    
    public function get_presentations($id){
        $cli = Conference::find($id)->presentations;
        
        return response()->json($cli);
        
        
    }
    
    
    public function get_sponsors($id){
         $cli = Conference::find($id)->sponsors;
        
        return response()->json($cli);
    }
    
    
    //POST FUNCTIONS
     public function register( Request $request){
        //Requires Client Authentication
         //Handles Payment
         //Research payment callback
        $reg = new Conference;
        $reg->name = $request->input('name');
        $reg->type = $request->input('type');
        $reg->client_id = $request->input('client_id');
        $reg->address1 = $request->input('address1');
        $reg->address2 = $request->input('address2');
        $reg->city = $request->input('city');
        $reg->country = $request->input('country');
        $reg->start_time = $request->input('start_time');
        $reg->end_time = $request->input('end_time');
        
        $reg->save();
        
        return response()->json("New conference added!");
    }
    
    
    public function create_new_presentation(Request $request, $id)
    {
       $conference = Conference::find($id);
       
       $presentation = new Presentation;
       $presentation->title= $request->input('title');
       $presentation->abstract= $request->input('abstract');
       $presentation->keywords= $request->input('keywords');
       $presentation->room_id= $request->input('room_id');
       
       
       $conference->presentations()->save($presentation);
        
       return response()->json("New presentation added!");
    }
    
    
    public function create_new_sponsor(Request $request, $id)
    {
       $conference = Conference::find($id);
       
       $sponsor = new Sponsor;
       $sponsor->name = $request->input('name');
       $sponsor->description = $request->input('description');
       $sponsor->image_path = $request->input('image_path');
       $sponsor->website = $request->input('website');
       
       
       $conference->sponsors()->save($sponsor);
       
       return response()->json("New sponsor added!");
    }
    
    
    //DELETE FUNCTION

    public function delete_conference($id){
        $del  = Conference::find($id);
 
        $del->delete();
 
        return response()->json('Conference has been removed');
    }
    
    public function delete_sponsor($id, Request $request){
        $sponsorid = $request->input('id');
        $del  = Conference::find($id)->sponsors()->where('sponsor_id', $sponsorid)->first();
 
        $del->delete();
 
        return response()->json("Sponsor removed");
    }


    //PUT FUNCTION
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

    //GET and POST for Conference Presentations, Conference Sponsors
    
}
