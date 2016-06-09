<?php

namespace App\Http\Controllers;

use App\Models\Speaker;

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
    
    

    public function get_id($id) {

        $cli = Speaker::find($id);

        return response()->json($cli);
    }
    
    //GET for Speaker Presentations
    public function get_presentations($id){
        $cli = Speaker::find($id)->presentations;
        
        return response()->json($cli);
    }

    //POST FUNCTION
    public function create_new(Request $request)
    {
        $speaker = new Speaker;
        
        $speaker->name = $request->input('name');
        $speaker->email = $request->input('email');
        $speaker->affiliation = $request->input('affiliation');
        $speaker->telephone = $request->input('telephone');
        $speaker->image_path = $request->input('image_path');
        
        $speaker->save();
        
        return response()->json("Speaker added!");
        
    }

    
}
