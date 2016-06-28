<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Presentation;
use App\Models\Sponsor;
use App\Models\Blacklist;

//use Illuminate\Http\Request;
//
//use Illuminate\Http\Exception\HttpResponseException;
//use JWTAuth;
//use Tymon\JWTAuth\Exceptions\JWTException;
//use App\Http\Controllers\Controller;
//
//use Illuminate\Http\Response as IlluminateResponse;


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
 /*   
    // somewhere in your controller
public function getAuthenticatedUser()
{
    try {
            
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['token_expired'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['token_invalid'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        return response()->json(['token_absent'], $e->getStatusCode());

    }

    // the token is valid and we have found the user via the sub claim
    return response()->json(compact('user'));
}
*/
    
    //GET FUNCTIONS
    public function get_all() {
        //Get all PUBLIC Conferences
        
        
        $all = Conference::all()->where('type', 'public');
        
        return response()->json($all);
    }


    //GET ID FUNCTION
    public function get_id($id) {
        if(!$cli = Conference::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    
    //GET PRESENTATION BY ID FUNCTION
    public function get_presentations($id){
        if(!$cli = Conference::find($id)->presentations)
            return response()->json([], 404);
        
        return response()->json($cli);
        
        
    }
    
    public function select_presentation($id){
        if(!$cli = Conference::find($id)->presentations->first())
            return response()->json([], 404);
        
        return response()->json($cli);
    }
    
    public function get_conference_speakers($id){
        if(!$cli = Conference::find($id)->presentations)
            return response()->json([], 404);
        
        $cli = Conference::with([
            'presentations'=> function ($q) use ($id){
        $q->where('conference_id', $id); //constraint on child
        },'presentations.speakers' => function ($q) {
            //$q->where('presentation_id', ''); //constraint on grandchild
        }
        ])->find($id);
         
//        $cli = Conference::whereHas('presentations.speakers', function ($q) use ($id){
//         $q->where('conference_id', 'like', $id);
            
//        })->get();
        
        //if(!$cli = Conference::find($id)->presentations()->speakers)
        //    return response()->json([], 404);
        
        return response()->json($cli);
    }
    
    
    //GET SPONSORS FUNCTION
    public function get_sponsors($id){
         if(!$cli = Conference::find($id)->sponsors)
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
    
    
    //CREATE NEW PRESENTATION FUNCTION
    public function create_new_presentation(Request $request, $id){
       if(!$conference = Conference::find($id))
            return response()->json([], 404);
       
       $presentation = new Presentation;
       $presentation->title= $request->input('title');
       $presentation->abstract= $request->input('abstract');
       $presentation->keywords= $request->input('keywords');
       $presentation->room_id= $request->input('room_id');
       
       
       $conference->presentations()->save($presentation);
        
       return response()->json($conference);
    }
    
    
    //CREATE SPONSOR ID FUNCTION
    public function create_new_sponsor(Request $request, $id){
       if(!$conference = Conference::find($id))
            return response()->json([], 404);
       
       $sponsor = new Sponsor;
       $sponsor->name = $request->input('name');
       $sponsor->description = $request->input('description');
       $sponsor->image_path = $request->input('image_path');
       $sponsor->website = $request->input('website');
       
       
       $conference->sponsors()->save($sponsor);
       
       return response()->json($conference);
    }
    
    public function add_to_whitelist(Request $request, $id)
    {
        if(!$conference = Conference::find($id))
            return response()->json([], 404);
        
        $whitelist = new Whitelist;
        $whitelist->conference_id = $id;
        $whitelist->attendee_id = $request->input('attendee_id');
        $whitelist->email = $request->input('email');
        $whitelist->token = $request->input('token');
        $whitelist->type = $request->input('type');
        
        $conference->whitelist()->save($whitelist);
        
        return response()->json($whitelist);
    }
    
    public function add_to_blacklist(Request $request, $id)
    {
        //Client authentication required for adding attendees to blacklist
        if(!$conference = Conference::find($id))
            return response()->json([], 404);
        
        $blacklist = new Blacklist;
        $blacklist->conference_id = $id;
        $blacklist->attendee_id = $request->input('attendee_id');
        
        
        $conference->blacklist()->save($blacklist);
        
        return response()->json($blacklist);
    }
    
    
    //DELETE FUNCTION
    public function delete_conference($id){
        if(!$del  = Conference::find($id))
            return response()->json([], 404);
 
        $del->delete();
 
        return response()->json($del);
    }
    
    //DELETE PRESENTATION BY ID FUNCTION
    public function delete_presentation(Request $request, $id)
    {
        $presentationid = $request->input('presentation_id');
        
        if(!$del  = Conference::find($id)->presentations()->where('presentation_id', $presentationid)->first())
            return response()->json([], 404);

        $del->delete();
 
        return response()->json($del);
    }
    
    //DELETE SPONSOR BY ID FUNCTION
    public function delete_sponsor($id, Request $request){
        $sponsorid = $request->input('sponsor_id');
        
        if(!$del  = Conference::find($id)->sponsors()->where('sponsor_id', $sponsorid)->first())
            return response()->json([], 404);

        $del->delete();
 
        return response()->json($del);
    }

    //DELETE PRESENTATION BY ID FUNCTION
    /*
    public function delete_presentation($id, Request $request){
        $presentationid = $request->input('presentation_id');
        
        if(!$del  = Conference::find($id)->presentations()->where('presentation_id', $presentationid)->first())
            return response()->json([], 404);

        $del->delete();
 
        return response()->json($del);
    }
    */
    
     public function remove_from_whitelist()
     {
         
     }
    
    public function remove_from_blacklist()
    {
        
    }
    


    //PUT FUNCTION
    public function edit_conference(Request $request,$id){
        if(!$edit  = Conference::find($id))
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

    
    
}
