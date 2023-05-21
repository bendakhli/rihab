<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pointage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PointageController extends Controller
{
    public function store(Request $request)
{
    // Get the latest pointage instance on the current day
    $latestPointage = Pointage::whereDate('created_at', Carbon::now()->toDateString())->latest()->first();

    // Determine the type for the new pointage instance based on the latest instance
    $newType = $latestPointage && $latestPointage->type == 1 ? 0 : 1;
    
    $validator =Validator::make($request->all(),[
        'employees_id'=>'required',
        'lat'=>'numeric',
        'long'=>'numeric'
    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'message' => 'validation fails',
            'errors' => $validator->errors()
        ], 422);
    }
    $pointage = Pointage::create([
        'type' => $newType,
        'lat' => $request->lat,
        'long' => $request->long ?? 0, // set a default value of 0 if longitude is not provided
        'employees_id' => $request->employees_id
    ]);
    
    
    

    return response()->json([
        'message' => 'Enregitred successfully',
        'data' => $pointage
    ], 200);
}
    public function index(Request $request){
    $pointages = Pointage::all();
    return response()->json([
        'status'=>true,
        'message'=>'pointage retrieved..',
        'data'=> $pointages,
      ]);
}
    public function show(Request $request,$id){
    $pointage = Pointage::find($id);
    return response()->json([
        'status'=>true,
        'message'=>'pointage found.',
        'data'=>$pointage,
      ]);
}
public function update(Request $request,$id){
    $data = $request->validate([
        'employees_id'=>'required',
        'lat'=>'numeric',
        'long'=>'numeric',
        'type'=>'boolean',
        
    ]);
    $pointage= Pointage::find($id);
       if($pointage){
        $pointage->update($data);
        return response()->json([
            'status'=>true,
            'message'=>'pointage found.',
            'data'=> $pointage,
          ]);
    }
    else{
        return response()->json([
            'status'=>false,
            'message'=>'pointage not found.',
            'data'=> null,
          ], 404);
    }
     
    
} public function delete(Request $request,$id){
       
    $pointage = Pointage::find($id);
       if($pointage){
        $pointage->delete;
        return response()->json([
            'status'=>true,
            'message'=>'empoloye found.',
            'data'=> $pointage,
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

public function getPointageByEmployeeIdGroupedByDay(Request $request, $employeeId)
{
    $pointages = Pointage::select(DB::raw('DATE(created_at) AS date'), 'employees_id', 'lat', 'long', 'type')
        ->where('employees_id', $employeeId)
        ->groupBy('date', 'employees_id', 'lat', 'long', 'type')
        ->get();

    $groupedPointages = $pointages->groupBy('date')->map(function ($group) {
        return $group->map(function ($pointage) {
            return [
                'employees_id' => $pointage->employees_id,
                'lat' => $pointage->lat,
                'long' => $pointage->long,
                'type' => $pointage->type,
            ];
        });
    });

    $result = $groupedPointages->map(function ($pointages, $date) {
        return [
            'date' => $date,
            'list' => $pointages->values(),
        ];
    })->values();

    return response()->json([
        'status' => true,
        'message' => 'Pointage retrieved.',
        'data' => $result,
    ]);
}
    }

   


