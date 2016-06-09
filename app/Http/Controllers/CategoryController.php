<?php

namespace App\Http\Controllers;

use App\Models\Category;

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

        $cli = Category::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_category($id){
        $del  = Category::find($id);
 
        $del->delete();
 
        return response()->json('Category has been removed');
    }


    //THIS NEEDS TO BE EDITED
    public function edit_category(Request $request,$id){
        $edit  = Category::find($id);

        $edit->title = $request->input('title');
        $edit->content = $request->input('content');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
