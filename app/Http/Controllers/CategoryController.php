<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Presentation;
use Illuminate\Http\Request;

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

    //GET FUNCTIONS
    public function get_all() {

        $all = Category::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Category::find($id);

        return response()->json($cli);
    }
    
    public function get_presentations($id)
    {
        $cli = Category::find($id)->presentations;
        
        return response($cli);
    }
    
    //POST FUNCTION
    public function create_new(Request $request)
    {
        $category = new Category;
        
        $category->name = $request->input('name');
        $category->keywords = $request->input('keywords');
        $parent_id->parent_id = $request->input('parent_id');
        
        $category->save();
        $category->find($category->category_id)->presentations()->attach($request->input('presentation_id'), ['created_at'=>$category->created_at, 'updated_at'=>$category->updated_at]);
        
        return response()->json('Category has been added');
    }
    

    //DELETE FUNCTION

    public function delete_category($id){
        $del  = Category::find($id);
 
        $del->delete();
 
        return response()->json('Category has been removed');
    }


    //PUT FUNCTION
    public function edit_category(Request $request,$id){
        $edit  = Category::find($id);

        $edit->name = $request->input('name');
        $edit->keywords = $request->input('keywords');
        $edit->parent_id = $request->input('parent_id');
        
        $edit->save();
        
        $edit->presentations()->updateExistingPivot($request->input('presentation_id'), ['updated_at'=> $edit->updated_at]);
  
        return response()->json($edit);
    }

 
}
