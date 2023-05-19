<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveRequestController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'duration' => 'required|integer',
            'reason' => 'required|string',
            'status'=> 'required|integer',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $response = [
                'status' => 405,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ];

            return response()->json($response, 200);
        }

        // Create the leave request
        $leaveRequest = LeaveRequest::create($request->all());

        // Format the response
        $response = [
            'status' => 200,
            'message' => 'Success',
            'data' => $leaveRequest,
        ];

        return response()->json($response, 200);
    }

    public function accept(Request $request, $id)
    {
        // Find the leave request
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Update the status to 'Accepted' (1)
        $leaveRequest->status = 1;
        $leaveRequest->save();

        // Format the response
        $response = [
            'status' => 200,
            'message' => 'Leave request accepted',
            'data' => $leaveRequest,
        ];

        return response()->json($response, 200);
    }

    public function deny(Request $request, $id)
    {
        // Find the leave request
        $leaveRequest = LeaveRequest::findOrFail($id);

        // Update the status to 'Denied' (2)
        $leaveRequest->status = 2;
        $leaveRequest->save();

        // Format the response
        $response = [
            'status' => 200,
            'message' => 'Leave request denied',
            'data' => $leaveRequest,
        ];

        return response()->json($response, 200);
    }


    public function getByEmployee($employeeId)
    {
        // Find the employee
        $employee = Employee::findOrFail($employeeId);

        // Retrieve the leave requests for the employee
        $leaveRequests = $employee->leaves;

        // Format the response
        $response = [
            'status' => 200,
            'message' => 'Success',
            'data' => $leaveRequests,
        ];

        return response()->json($response, 200);
    }

    public function getAll()
    {
        // Retrieve all leave requests
        $leaveRequests = LeaveRequest::all();

        // Format the response
        $response = [
            'status' => 200,
            'message' => 'Success',
            'data' => $leaveRequests,
        ];

        return response()->json($response, 200);
    }
}
