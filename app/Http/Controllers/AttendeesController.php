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

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
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
            return response()->json(['error' => 'invalid_credentials'], 404);
        }

        return response()->json(Auth::guard('attendee')->user());
    }

    public function register(Request $request){
        $regex = '/(?=.*[0-9])(?=.*[A-Z])(?=.*).{8,}/'; //at least 8 characters including at least 1 Uppercase and 1 digit required
        $result = $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:' . $regex,
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
        $attendee->find($attendee->attendee_id)->conferences()->attach($request->input('conference_id'), ['created_at'=>$attendee->created_at, 'updated_at'=>$attendee->updated_at]);

        return response()->json($attendee);
    }

    //GET FUNCTIONS
    public function get_all() {

        $all = Attendee::all();

        return response()->json($all);
    }

    //GET BY ID FUNCTION
    public function get_id($id) {
        if(!$cli = Attendee::find($id))
            return response()->json([], 404);

        return response()->json($cli);
    }

    //POST FUNCTIONS

/*
     public function register( Request $request){

        $reg = new Attendee;
        $reg->name = $request->input('name');
        $reg->email = $request->input('email');
        $reg->salted_password = $request->input('salted_password');

        $reg->save();
        $reg->find($reg->attendee_id)->conferences()->attach($request->input('conference_id'), ['created_at' => $reg->created_at, 'updated_at' => $reg->updated_at]);

        return response()->json("New attendee added!");
    }
    */



    //CHANGE PASSWORD FUNCTION
    public function change_password($id, Request $request){
        if(!$pEdit = Attendee::find($id))
            return response()->json([], 404);

        $pEdit->salted_password = $request->input('salted_password');
        $pEdit->save();

        return response()->json("Password changed successfully!");
    }


    //DELETE FUNCTION

    public function delete_attendee($id){
        if (!$del  = Attendee::find($id))
            return response()->json([], 404);

        $del->delete();

        return response()->json($del);
    }


        //PUT FUNCTION
    public function edit_attendee(Request $request,$id){
        if (!$edit  = Attendee::find($id))
            return response()->json($del);

        $edit->name = $request->input('name');
        $edit->email = $request->input('email');
        $edit->salted_password = $request->input('salted_password');

        $edit->save();
        $edit->conferences()->updateExistingPivot($request->input('conference_id'), ['updated_at' => $edit->updated_at]);


        return response()->json($edit);
    }


    //GET CONFERENCES FUNCTION
    public function get_conferences($id){
        if (!$cli = Attendee::find($id))
            return response()->json([], 404);

        return response()->json($cli->conferences);
    }


}
