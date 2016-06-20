<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use App\Models\Presentation;

use Illuminate\Http\Request;

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
    
    public function get_all() {

        $all = Speaker::all();
        
        return response()->json($all);
    }
    
    
    //GET BY ID FUNCTION
    public function get_id($id) {
        if(!$cli = Speaker::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    //GET for Speaker Presentations
    public function get_presentations($id){
        if(!$cli = Speaker::find($id))
            return response()->json([], 404);
        
        if(!$cli = Speaker::find($id)->presentations)
            return response()->json([], 404);
        
        return response()->json($cli);
    }
    
    public function get_conference_speakers($id){
        $cli = Speaker::whereHas('presentations', function($q) use ($id){
        
            $q->where('conference_id', $id);
                
        })->get();
        
        return response()->json($cli);
    }

    //POST FUNCTION
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
     public function delete_speaker($id)
    {
        if (!$del  = Speaker::find($id))
                return response()->json([], 404);
        Speaker::find($id)->presentations()->detach($id);
        $del->delete();
        
        
        return response()->json($del);
    }

    
}
