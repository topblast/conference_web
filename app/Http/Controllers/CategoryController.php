<?php
/**
 * CategoryController.php
 */
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Presentation;
use Illuminate\Http\Request;

/**
 * Controller for the Category Model.
 * 
 * *CategoryController* is a controller for the Category Model, which is the data model for the categories table. 
 * @filesource
 */
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
    /**
     * Gets all categories.
     * @return type
     * Returns category details as JSON data.
     */
    public function get_all() {

        $all = Category::all();
        
        return response()->json($all);
    }

    //GET BY ID FUNCTION
    /**
     * Gets a category based on id
     * @param type $id
     * @return type
     * Returns category details as JSON data if successful, 404 and empty JSON array if unsuccessful.
     */
    public function get_id($id) {
        if(!$cli = Category::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    //GET PRESENTATION FUNCTION
    /**
     * Gets all presentations related to a category using id as parameter
     * @param type $id
     * @return type
     * Returns presentations as JSON data if successful, 404 and empty JSON array if unsuccessful
     */
    public function get_presentations($id){
        if(!$cli = Category::find($id)->presentations)
            return response()->json([], 404);            
        
        return response($cli);
    }
    
    //POST FUNCTION
     /**
     * Creates a new category.
     * @param Request $request
     * The POST request
     * @return type
     * returns category details as JSON data.
     */
    public function create_new(Request $request)
    {
        $category = new Category;
        
        $category->name = $request->input('name');
        $category->keywords = $request->input('keywords');
        $category->parent_id = $request->input('parent_id');
        
        $category->save();
        $category->find($category->category_id)->presentations()->attach($request->input('presentation_id'), ['created_at'=>$category->created_at, 'updated_at'=>$category->updated_at]);
        
        return response()->json($category);
    }
    

    //DELETE FUNCTION
    /**
     * Deletes an existing category based on id
     * @param type $id
     * @return type
     * Returns category details as JSON data if successful, 404 error and an empty JSON array if unsuccessful.
     */
    public function delete_category($id){
        if(!$del  = Category::find($id))
            return response()->json([], 404);            
 
        $del->delete();
 
        return response()->json($del);
    }


    //PUT FUNCTION
    /**
     * Edits an existing category
     * @param Request $request
     * The PUT request.
     * @param type $id
     * @return type
     * Returns edited category details as JSON data, or a 404 error if the requested category cannot be found.
     */
    public function edit_category(Request $request,$id){
        if(!$edit  = Category::find($id))
            return response()->json([], 404);            

        $edit->name = $request->input('name');
        $edit->keywords = $request->input('keywords');
        $edit->parent_id = $request->input('parent_id');
        
        $edit->save();
        
        $edit->presentations()->updateExistingPivot($request->input('presentation_id'), ['updated_at'=> $edit->updated_at]);
  
        return response()->json($edit);
    }

 
}
