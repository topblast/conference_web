<?php

namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Http\Request;


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

    //GET FUNCTIONS
    public function get_all() {

        $all = Client::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }
    
    
    
    //POST FUNCTIONS
     public function register( Request $request){
        
        $reg = new Client;
        $reg->contact_name = $request->input('contact_name');
        $reg->email = $request->input('email');
        $reg->salted_password = $request->input('salted_password');
        $reg->organisation = $request->input('organisation');
        $reg->address1 = $request->input('address1');
        $reg->address2 = $request->input('address2');
        $reg->city = $request->input('city');
        $reg->country = $request->input('country');
        
        $reg->save();
        
        return response()->json("New client added!");
    }
    
    public function change_password($id, Request $request){
        $pEdit = Client::find($id);
        
        $pEdit->salted_password = $request->input('salted_password');
        
        $pEdit->save();
        
        return response()->json("Password changed successfully!");
    }

    //DELETE FUNCTION

    public function delete_client($id){
        $del  = Client::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }

    //PUT FUNCTION
    public function edit_client($id, Request $request){
        $edit  = Client::find($id);

        $edit->contact_name = $request->input('contact_name');
        //$edit->email = $request->input('email');
        $edit->organisation = $request->input('organisation');  
        $edit->address1 = $request->input('address1');
        $edit->address2 = $request->input('address2');
        $edit->city = $request->input('city');
        $edit->country = $request->input('country');

 
        $edit->save();
  
        return response()->json($edit);
    }

   
    
}


/*
contact name
organisation
address1
address2
city
country
*/