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
        if(!$cli = Conference::find($id));
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    
    public function get_presentations($id){
        if(!$cli = Conference::find($id)->presentations);
            return response()->json([], 404);
        
        return response()->json($cli);
        
        
    }
    
    
    public function get_sponsors($id){
         if(!$cli = Conference::find($id)->sponsors);
            return response()->json([], 404);
        
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
        
        return response()->json($reg);
    }
    
    
    public function create_new_presentation(Request $request, $id){
       if(!$conference = Conference::find($id));
            return response()->json([], 404);
       
       $presentation = new Presentation;
       $presentation->title= $request->input('title');
       $presentation->abstract= $request->input('abstract');
       $presentation->keywords= $request->input('keywords');
       $presentation->room_id= $request->input('room_id');
       
       
       $conference->presentations()->save($presentation);
        
       return response()->json($conference);
    }
    
    
    public function create_new_sponsor(Request $request, $id){
       if(!$conference = Conference::find($id));
            return response()->json([], 404);
       
       $sponsor = new Sponsor;
       $sponsor->name = $request->input('name');
       $sponsor->description = $request->input('description');
       $sponsor->image_path = $request->input('image_path');
       $sponsor->website = $request->input('website');
       
       
       $conference->sponsors()->save($sponsor);
       
       return response()->json($conference);
    }
    
    
    //DELETE FUNCTION
//here
    public function delete_conference($id){
        if(!$del  = Conference::find($id));
            return response()->json([], 404);
 
        $del->delete();
 
        return response()->json($del);
    }
    
    public function delete_sponsor($id, Request $request){
        $sponsorid = $request->input('id');
        
        if(!$del  = Conference::find($id)->sponsors()->where('sponsor_id', $sponsorid)->first());
            return response()->json([], 404);

        $del->delete();
 
        return response()->json($del);
    }


    //PUT FUNCTION
    public function edit_conference(Request $request,$id){
        if(!$edit  = Conference::find($id));
            return response()->json([], 404);

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
