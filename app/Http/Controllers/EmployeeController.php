<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function index(){

        $employees = Employee::simplePaginate(15);
        
        return view('employees.index', compact('employees'));
    }

    public function import(Request $request){
        
        $validator = Validator::make($request->all(), [
            'employees' => 'required|file|mimes:csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        //import csv
        $employeesFile = fopen($request->employees, 'r');
        $employeesArray = array();
        $firstLoop = true;

        while($employee = fgetcsv($employeesFile)){
            if(!$firstLoop){
                $employeesArray[] = [
                    'date' => $employee[0],
                    'employee' => $employee[1],
                    'employer' => $employee[2],
                    'hours' => $employee[3],
                    'rate_per_hour' => $employee[4],
                    'taxable' => $employee[5] === 'yes' ? true : false,
                    'status' => $employee[6],
                    'shift_type' => $employee[7],
                    'paid_at' => $employee[8] === '' ? null : $employee[8]  
                ];
            }else{
                $firstLoop = false;
            }
        }

        foreach(array_chunk($employeesArray, 1000) as $data){
            Employee::insert($data);
        }
        fclose($employeesFile);
        return redirect()->back()->with('success', __('employee.import_success'));

    }



}
