<?php
/**
 * ConferencesController.php.
 */
namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Presentation;
use App\Models\Sponsor;
use App\Models\Blacklist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
/**
 * Controller for the conferences table.
 *
 * @filesource
 */
class ConferencesController extends Controller
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		//
               // $this->middleware('auth:attendee');
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
	/**
	 * Gets all public conferences.
	 *
	 * @return type
	 *              Returns all conference details in the form of JSON data
	 */
	public function get_all()
	{
		//Get all PUBLIC Conferences
		$user = Auth::guard('attendee')->user(); 
		$all = Conference::all()->where('type', 'public');
		
		return response()->json($all);
//                $payload = JWTAuth::parseToken()->getPayload();
//                return response()->json($payload);
	}
	
	//GET ID FUNCTION
	/**
	 * Gets a specific conference by its id.
	 *
	 * @param type $id
	 *
	 * @return type
	 *              Returns the details of that conference in the form of JSON data
	 */
	public function get_id($id)
	{
		if (!$cli = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		return response()->json($cli);
	}
	
	//GET PRESENTATION BY ID FUNCTION
	/**
	 * Gets all presentations related to a conference.
	 *
	 * @param type $id
	 *                 The conference's id.
	 *
	 * @return type
	 *              Returns those presentations as JSON data
	 */
	public function get_presentations($id)
	{
		if (!$cli = Conference::find($id)->presentations)
		{
			return response()->json(array(), 404);
		}
		
		return response()->json($cli);
	}
	
	/**
	 * Gets the first presentation at a conference.
	 *
	 * @param type $id
	 *                 The conference's id
	 *
	 * @return type
	 *              Returns that presentation as JSON data
	 */
	public function select_presentation($id)
	{
		if (!$cli = Conference::find($id)->presentations->first())
		{
			return response()->json(array(), 404);
		}
		
		return response()->json($cli);
	}
	
	/**
	 * Gets all speakers related to a conference.
	 *
	 * @param type $id
	 *                 The conference's id
	 *
	 * @return type
	 *              Returns those speakers as JSON data
	 */
	public function get_conference_speakers($id)
	{
		if (!$cli = Conference::find($id)->presentations)
		{
			return response()->json(array(), 404);
		}
		
		//refer to http://stackoverflow.com/questions/25714273/laravel-querying-and-accessing-child-objects-in-nested-relationship-with-where
		$cli = Conference::with(array(
			'presentations' => function($q) use ($id)
			{
				$q->where('conference_id', $id); //constraint on child
			},
			'presentations.speakers' => function($q)
			{
				//$q->where('presentation_id', ''); //constraint on grandchild
			}
		))->find($id);
		
		//$cli = Conference::whereHas('presentations.speakers', function ($q) use ($id){
		// $q->where('conference_id', 'like', $id);
		
		//})->get();
		
		//if(!$cli = Conference::find($id)->presentations()->speakers)
		//    return response()->json([], 404);
		
		return response()->json($cli);
	}
	
	//GET SPONSORS FUNCTION
	/**
	 * Gets all sponsors related to a conference.
	 *
	 * @param type $id
	 *                 The conference's id
	 *
	 * @return type
	 *              Returns those sponsors as JSON data
	 */
	public function get_sponsors($id)
	{
		if (!$cli = Conference::find($id)->sponsors)
		{
			return response()->json(array(), 404);
		}
		
		return response()->json($cli);
	}
	
	//POST FUNCTIONS
	/**
	 * attempts to register a new conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The POST request with conference details
	 *
	 * @return type
	 *              Returns the conference as a JSON object if successful, error message if unsuccessful
	 */
	public function register(Request $request)
	{
		//Requires Client Authentication
		//Handles Payment
		//Research payment callback
		$this->validate($request, [
			'name' => 'required',
			'type' => 'required',
		//	'client_id' => 'required|exists:clients,client_id',
			'address1' => 'required',
			'city' => 'required',
			'country' => 'required',
			'start_time' => 'required|date',
			'end_time' => 'required|date|after:start_date'
		]);

		$client = Auth::guard('client')->user();

		$reg             = new Conference();
		$reg->name       = $request->input('name');
		$reg->type       = $request->input('type');
		$reg->client_id  = $client->client_id; //$request->input('client_id');
		$reg->address1   = $request->input('address1');
		$reg->address2   = $request->input('address2');
		$reg->city       = $request->input('city');
		$reg->country    = $request->input('country');
		$reg->start_time = date('Y-M-D G:i:s'. strtotime($request->input('start_time')));
		$reg->end_time   = date('Y-M-D G:i:s'. strtotime($request->input('end_time')));
		
		$reg->save();
		
		return response()->json($reg);
	}
	
	//CREATE NEW PRESENTATION FUNCTION
	/**
	 * Creates a new presentation for the conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The POST request with presentation details
	 * @param type                          $id
	 *                                               The conference's id
	 *
	 * @return type
	 *              Returns conference as JSON object
	 */
	public function create_new_presentation(Request $request, $id)
	{
		if (!$conference = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$presentation           = new Presentation();
		$presentation->title    = $request->input('title');
		$presentation->abstract = $request->input('abstract');
		$presentation->keywords = $request->input('keywords');
		$presentation->room_id  = $request->input('room_id');
		
		$conference->presentations()->save($presentation);
		
		return response()->json($conference);
	}
	
	//CREATE SPONSOR ID FUNCTION
	/**
	 * Creates a new sponsor for the conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The POST request with sponsor details
	 * @param type                          $id
	 *                                               The conference's id
	 *
	 * @return type
	 *              Returns conference as JSON object
	 */
	public function create_new_sponsor(Request $request, $id)
	{
		if (!$conference = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$sponsor              = new Sponsor();
		$sponsor->name        = $request->input('name');
		$sponsor->description = $request->input('description');
		$sponsor->image_path  = $request->input('image_path');
		$sponsor->website     = $request->input('website');
		
		$conference->sponsors()->save($sponsor);
		
		return response()->json($conference);
	}
	
	public function add_to_whitelist(Request $request, $id)
	{
		if (!$conference = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$whitelist                = new Whitelist();
		$whitelist->conference_id = $id;
		$whitelist->attendee_id   = $request->input('attendee_id');
		$whitelist->email         = $request->input('email');
		$whitelist->token         = $request->input('token');
		$whitelist->type          = $request->input('type');
		
		$conference->whitelist()->save($whitelist);
		
		return response()->json($whitelist);
	}
	
	public function add_to_blacklist(Request $request, $id)
	{
		//Client authentication required for adding attendees to blacklist
		if (!$conference = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$blacklist                = new Blacklist();
		$blacklist->conference_id = $id;
		$blacklist->attendee_id   = $request->input('attendee_id');
		
		$conference->blacklist()->save($blacklist);
		
		return response()->json($blacklist);
	}
	
	//DELETE FUNCTION
	/**
	 * Deletes a conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The DELETE request
	 * @param type                          $id
	 *                                               The conference's id
	 *
	 * @return type
	 *              Returns conference details as JSON data
	 */
	public function delete_conference(Request $request, $id)
	{
		if (!$del = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$del->delete();
		
		return response()->json($del);
	}
	
	//DELETE PRESENTATION BY ID FUNCTION
	/**
	 * Deletes a presentation related to a conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The DELETE request
	 * @param type                          $id
	 *
	 * @return type
	 *              Returns presentation details as JSON data
	 */
	public function delete_presentation(Request $request, $id)
	{
		$presentationid = $request->input('presentation_id');
		
		if (!$del = Conference::find($id)->presentations()->where('presentation_id', $presentationid)->first())
		{
			return response()->json(array(), 404);
		}
		
		$del->delete();
		
		return response()->json($del);
	}
	
	//DELETE SPONSOR BY ID FUNCTION
	/**
	 * Deletes a sponsor related to a conference.
	 *
	 * @param type                          $id
	 *                                               The conference's id
	 * @param \App\Http\Controllers\Request $request
	 *                                               The DELETE request
	 *
	 * @return type
	 *              Returns sponsor details as JSON data
	 */
	public function delete_sponsor($id, Request $request)
	{
		$sponsorid = $request->input('sponsor_id');
		
		if (!$del = Conference::find($id)->sponsors()->where('sponsor_id', $sponsorid)->first())
		{
			return response()->json(array(), 404);
		}
		
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
	/**
	 * Edits an existing conference.
	 *
	 * @param \App\Http\Controllers\Request $request
	 *                                               The PUT request
	 * @param type                          $id
	 *                                               The conference's id
	 *
	 * @return type
	 *              Returns the edited conference's details as JSON data
	 */
	public function edit_conference(Request $request, $id)
	{
		if (!$edit = Conference::find($id))
		{
			return response()->json(array(), 404);
		}
		
		$edit->name     = $request->input('name');
		$edit->type     = $request->input('type');
		$edit->address1 = $request->input('address1');
		$edit->address2 = $request->input('address2');
		$edit->city     = $request->input('city');
		$edit->country  = $request->input('country');
		$edit->start    = $request->input('start');
		$edit->end      = $request->input('end');
		
		$edit->save();
		
		return response()->json($edit);
	}
}
