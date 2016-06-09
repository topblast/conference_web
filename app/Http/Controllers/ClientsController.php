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
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return response()->json(Auth::guard('client')->user());
    }

    public function register(Request $request){
        $result = $this->validate($request,[
            'contact_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
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

    public function get_all() {

        $all = Client::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Client::find($id);

        return response()->json($cli);
    }

    //PUT FUNCTION

    public function delete_client($id){
        $del  = Client::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }

    //PUT FUNCTION
    public function edit_client($id, Request $request){
        $edit  = Client::find($id);

        $edit->contact_name = $request->input('contact_name');
        $edit->organisation = $request->input('organisation');  
        $edit->address1 = $request->input('address1');
        $edit->address2 = $request->input('address2');
        $edit->city = $request->input('city');
        $edit->country = $request->input('country');

 
        $edit->save();
  
        return response()->json($edit);
    }

}


