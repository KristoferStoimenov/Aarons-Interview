<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{

    public function index(){

        $employees = Employee::with('shift_type', 'status')->get();
        
        return view('employees.index', compact('employees'));
    }

    public function import(Request $request){
        
        $validator = Validator::make($request->all(), [
            'employees' => 'required|file|mimes:csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

    }



}
