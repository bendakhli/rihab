<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Hash;
use Illuminate\Support\Facades\Validator; 

class AuthController extends Controller
{
    public function sign_in(Request $request){
      
        $validator =Validator::make($request->all(),[
             'is_admin'=>'required',
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
      $user = new User();
      $user->is_admin= $request->is_admin;
      $user->email = $request->email;
      $user->password = hash::make($request->password);
      $user->save();
  

    
   

    if (!$request->is_admin) {
        $employee= new Employee();
        $employee->user_id= $user->id;
        $employee->name= $request->name;
        $employee->lastname=$request->lastname;
         $employee->post= $request->post;
        $employee->department= $request->department;
        $employee->save();
        
        
    }
    
    return response()->json([
        'message'=>'registration successfuly',
        'data'=>$user
       ],200);
}

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email'=>'required|email',
        'password'=>'required|min:6|max:100', 
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
        // Get the authenticated user's Employee data
        $user = auth()->user();
        $employee = $user->employee;

        // Authentication successful, return the authenticated user data and associated employee data
        return response()->json([
            'message' => 'Authentication successful',
            'data' => $user
            
        ], 200);
    } else {
        // Authentication failed, return an error response
        return response()->json([
            'message' => 'Authentication failed',
            'erreur' => 'Invalid credentials',
        ], 401);
    }
}}