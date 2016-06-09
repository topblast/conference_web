<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AttendeesController extends Controller
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

        if (!Auth::guard('attendee')->attempt($credentials))
        {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        return response()->json(Auth::guard('attendee')->user());
    }

    public function register(Request $request){
        $result = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
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

        $attendee_into = $request->only(
            'name',
            'email',
            'password'
        );

        if (Attendee::where('email', $attendee_into['email'])->count() > 0)
        {
            // Email Exist
            return response()->json([
                'error'=> [
                    'message' => 'Email already in use',
                ]
            ], 409 );
        }

        $attendee_into['password'] = Hash::make($attendee_into['password']);
        $attendee = Attendee::create($attendee_into);
        return response()->json($attendee);
    }
    
    //GET FUNCTIONS
    public function get_all() {

        $all = Attendee::all();
        
        return response()->json($all);
    }


    public function get_id($id) {

        $cli = Attendee::find($id);
        
        // $cli = Attendee::query()->findOrFail($id);
        return response()->json($cli);
        //return view('test', ['attendee' => $cli]); 
    }

    //POST FUNCTIONS
    public function change_password($id, Request $request){
        $pEdit = Attendee::find($id);
        
        $pEdit->salted_password = $request->input('salted_password');
        
        $pEdit->save();
        
        return response()->json("Password changed successfully!");
    }
    
    
    //DELETE FUNCTION

    public function delete_attendee($id){
        $del  = Attendee::find($id);
 
        $del->delete();
 
        return response()->json('Client has been removed');
    }


        //PUT FUNCTION
    public function edit_attendee(Request $request,$id){
        $edit  = Attendee::find($id);

        $edit->name = $request->input('name');
        $edit->email = $request->input('email');
 
        $edit->save();
  
        return response()->json($edit);
    }


}
