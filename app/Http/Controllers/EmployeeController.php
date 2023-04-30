<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function store(request $request){
       
        $validator =Validator::make($request->all(),[
            'name'=>'required|string|max:100' ,
             'lastname'=>'required|string|max:100',
             'post'=>'required|string|max:100',
             'department'=>'required|string|max:100',
             

        ]);


        if ($validator->fails()) {
          return response()->json([
              'message' => 'validation fails',
              'errors' => $validator->errors()
          ], 422);
      }

      $employee = Employee::create([
      'name'=>$request->name,
      'lastname'=>$request->lastname,
       'post'=>$request->post,
       'department'=>$request->department
    ]);
    
    return response()->json([
        'message'=>'registration successfuly',
        'data'=>$employee
       ],200);
    }
    public function index(Request $request){
        $employees = Employee::all();
        return response()->json([
            'status'=>true,
            'message'=>'empoloye retrieved.',
            'data'=> $employees,
          ]);
    }
    public function show(Request $request,$id){
        $employee = Employee::find($id);
        return response()->json([
            'status'=>true,
            'message'=>'empoloye found.',
            'data'=> $employee,
          ]);
    }
    public function update(Request $request,$id){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'lastname'=>'required|string|max:255',
            'post'=>'required|string|max:255',
            'department'=>'required|string|max:255'
        ]);
        $employee = Employee::find($id);
           if($employee){
            $employee->update($data);
            return response()->json([
                'status'=>true,
                'message'=>'empoloye found.',
                'data'=> $employee,
              ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'empoloye not found.',
                'data'=> null,
              ], 404);
        }
    }
    public function delete(Request $request,$id){
       
        $employee = Employee::find($id);
           if($employee){
            $employee->delete;
            return response()->json([
                'status'=>true,
                'message'=>'empoloye found.',
                'data'=> $employee,
              ]);

        }
        else{
            
            return response()->json([
                'status'=>false,
                'message'=>'empoloye not found.',
                'data'=> null,
              ], 404);
        }
    }
}



