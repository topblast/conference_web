<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

    //LOGIN FUNCTION
    public function login(Request $request) {
        $result = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (isset($result->error))
        {
            return response()->json([
                'error'=> [
                    'message' => 'Verification Failed',
                    'result' => $result->error
                ]
            ], IlluminateResponse::HTTP_BAD_REQUEST);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::guard('client')->attempt($credentials))
        {
            return response()->json(['error' => 'invalid_credentials'], 404);
        }

        return response()->json(Auth::guard('client')->user());
    }

    //REGISTER FUNCTION
    public function register(Request $request){
         $regex = '/(?=.*[0-9])(?=.*[A-Z])(?=.*).{8,}/'; //at least 8 characters including at least 1 Uppercase and 1 digit required
        $result = $this->validate($request,[
            'contact_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex' . $regex,
            'organisation' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if (isset($result->error))
        {
            return response()->json([
                'error'=> [
                    'message' => 'Verification Failed',
                    'result' => $result->error
                ]
            ], IlluminateResponse::HTTP_BAD_REQUEST);
        }

        $client_into = $request->only(
            'contact_name',
            'email',
            'password',
            'organisation',
            'address1',
            'address2',
            'city',
            'country'
        );

        if (Client::where('email', $client_into['email'])->count() > 0)
        {
            // Email Exist
            return response()->json([
                'error'=> [
                    'message' => 'Email already in use',
                ]
            ], 409 );
        }

        $client_into['password'] = Hash::make($client_into['password']);
        $cli = Client::create($client_into);
        return response()->json($cli);
    }

    //GET FUNCTIONS
    public function get_all() {
        if(!$all = Client::all())
            return response()->json([], 404);
        
        return response()->json($all);
    }

    //GET BY ID FUNCTION
    public function get_id($id) {
        if(!$cli = Client::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }
    
    
    
    //POST FUNCTIONS    
    public function change_password($id, Request $request){
        if(!$pEdit = Client::find($id))
            return response()->json([], 404);

        $pEdit->salted_password = $request->input('password');
        
        $pEdit->save();
        
        return response()->json($pEdit);
    }

    //DELETE FUNCTION
    public function delete_client($id){
        if(!$del  = Client::find($id))
            return response()->json([], 404);
 
        $del->delete();
 
        return response()->json($del);
    }

    //PUT FUNCTION
    public function edit_client($id, Request $request){
        if(!$edit  = Client::find($id))
            return response()->json([], 404);

        $edit->contact_name = $request->input('contact_name');
        $edit->email = $request->input('email');
        $edit->organisation = $request->input('organisation');  
        $edit->address1 = $request->input('address1');
        $edit->address2 = $request->input('address2');
        $edit->city = $request->input('city');
        $edit->country = $request->input('country');

        //no password is needed as we have an edit password function
        //have values loaded for put function, so as to not have blank fields

 
        $edit->save();
  
        return response()->json($edit);
    }

   
    
}

