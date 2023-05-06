<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Demandeconge;
class CongeController extends Controller
{
    public function store(request $request ){

       
        $validator =Validator::make($request->all(),[
            'name'=>'required|string|max:100' ,
             'lastname'=>'required|string|max:100',
             'type'=>'boolean',
             'number_days'=>'required|string',
             'date_depart'=>'required',
             'date_fin'=>'required',
             

        ]);


        if ($validator->fails()) {
          return response()->json([
              'message' => 'validation fails',
              'errors' => $validator->errors()
          ], 422);
      }
      
      $demandeconge= new Demandeconge();
      $demandeconge->employee_name= $request->employee_name;
      $demandeconge->employee_lastname=$request->employee_lastname;
      $demandeconge->type= $type ;
      $demandeconge->number_days= $request->number_days;
      $demandeconge->date_depart=$request->date_depart;
      $demandeconge->date_fin=$request->date_fin;
      $demandeconge->save();
    
    return response()->json([
        'message'=>'registration successfuly',
        'data'=> $demandeconges
       ],200);
    }
}
