<?php

namespace App\Http\Controllers;

use App\Models\Client;

class ClientsController extends Controller
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
        
        return Client::all();
    }


    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_client($id){
        $del  = Client::find($id);
 
        $article->delete();
 
        return response()->json('Client has been removed');
    }

    public function edit_client($id){
        $edit  = Client::find($id);

        $article->title = $request->input('title');
        $article->content = $request->input('content');
 
        $article->save();
  
        return response()->json($edit);
    }


}
