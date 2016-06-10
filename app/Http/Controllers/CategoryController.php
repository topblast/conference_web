<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Presentation;

class CategoryController extends Controller
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

        $all = Category::all();
        
        return response()->json($all);
    }


    public function get_id($id) {
        if(!$cli = Category::find($id));
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    public function get_presentations($id){
        if(!$cli = Category::find($id)->presentations);
            return response()->json([], 404);            
        
        return response($cli);
    }
    

    //DELETE FUNCTION

    public function delete_category($id){
        if(!$del  = Category::find($id));
            return response()->json([], 404);            
 
        $del->delete();
 
        return response()->json($del);
    }


    //PUT FUNCTION
    public function edit_category(Request $request,$id){
        if(!$edit  = Category::find($id));
            return response()->json([], 404);            

        $edit->title = $request->input('title');
        $edit->content = $request->input('content');
 
        $edit->save();
  
        return response()->json($edit);
    }

 
}
