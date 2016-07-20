<?php
/**
 * SpeakersController.php
 */
namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Presentation;

use Illuminate\Http\Request;

/**
  * Controller for the Speaker Model.
  *
  * *SpeakersController* is a controller for the Speaker Model, which is the data model for the speakers table.
  * 
  */
class SpeakersController extends Controller
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
    /**
     * Gets all speakers in the model.
     * @return type
     */
    public function get_all() {

        $all = Speaker::all();
        
        return response()->json($all);
    }
    
    
    //GET BY ID FUNCTION
    /**
     * Gets one speaker based on id.
     * @param type $id
     * @return type
     */
    public function get_id($id) {
        if(!$cli = Speaker::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    //GET for Speaker Presentations
    /**
     * Gets all presentations a speaker is giving, based on the speaker's id.
     * @param type $id
     * @return type
     */
    public function get_presentations($id){
        if(!$cli = Speaker::find($id))
            return response()->json([], 404);
        
        if(!$cli = Speaker::find($id)->presentations)
            return response()->json([], 404);
        
        return response()->json($cli);
    }
    
    /**
     * Gets all speakers for a specific conference, based on the conference's id.
     * @param type $id
     * @return type
     */
    public function get_conference_speakers($id){
        $cli = Speaker::whereHas('presentations', function($q) use ($id){
        
            $q->where('conference_id', $id);
                
        })->get();
        
        return response()->json($cli);
    }

    //POST FUNCTION
    /**
     * creates a new Speaker in the speaker's table.
     * @param Request $request
     * @return type
     */
    public function create_new(Request $request){
        $speaker = new Speaker;
        
        $speaker->name = $request->input('name');
        $speaker->email = $request->input('email');
        $speaker->affiliation = $request->input('affiliation');
        $speaker->telephone = $request->input('telephone');
        $speaker->image_path = $request->input('image_path');
        
        $speaker->save();
        

        $speaker->find($speaker->speaker_id)->presentations()->attach($request->input('presentation_id'),['type'=>$request->input('type'), 'created_at' => $speaker->created_at]);
        

        return response()->json($speaker);

        
    }
    
    //DELETE FUNCTION
    /**
     * Deletes speaker from the speakers table.
     * @param type $id
     * @return type
     */
     public function delete_speaker($id)
    {
        if (!$del  = Speaker::find($id))
                return response()->json([], 404);
        Speaker::find($id)->presentations()->detach($id);
        $del->delete();
        
        
        return response()->json($del);
    }

    
}
