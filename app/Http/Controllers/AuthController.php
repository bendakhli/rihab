<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Hash;
use Illuminate\Support\Facades\Validator; 

class AuthController extends Controller
{
    public function sign_in(Request $request){
      
        $validator =Validator::make($request->all(),[
            'name'=>'required|min:2|max:100' ,
             'lastname'=>'required|min:2|max:100',
             'email'=>'required|email|unique:users',
             'password'=>'required|min:6|max:100',
             'checked_password'=>'required|same:password'

        ]);


        if ($validator->fails()) {
          return response()->json([
              'message' => 'validation fails',
              'errors' => $validator->errors()
          ], 422);
      }

    $user=User::create([
      'name'=>$request->name,
      'lastname'=>$request->lastname,
       'email'=>$request->email,
       'password'=>hash::make($request->password)
    ]);
    
    return response()->json([
        'message'=>'registration successfuly',
        'data'=>$user
       ],200);
}

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'message' => 'validation fails',
            'erreur' => $validator->errors(),
        ], 400);
    }
    
    // Attempt to authenticate the user with the provided credentials
    $credentials = $request->only('email', 'password');
    if (auth()->attempt($credentials)) {
        // Authentication successful, return the authenticated user data
        return response()->json([
            'message' => 'Authentication successful',
            'data' => auth()->user(),
        ], 200);
    } else {
        // Authentication failed, return an error response
        return response()->json([
            'message' => 'Authentication failed',
            'erreur' => 'Invalid credentials',
        ], 401);
    }
}}