<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;

class ShiftController extends Controller
{

    public function index(){
        
        $shifts = Employee::select('*', DB::raw('rate_per_hour * hours as total_pay'))->simplePaginate(15);
        
        return view('shifts.index', compact('shifts'));
    }

    public function import(Request $request){
        
        $validator = Validator::make($request->all(), [
            'shifts' => 'required|file|mimes:csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        //import csv
        $shiftsFile = fopen($request->shifts, 'r');
        $shiftsArray = array();
        $firstLoop = true;

        while($shift = fgetcsv($shiftsFile)){
            if(!$firstLoop){
                $shiftsArray[] = [
                    'date' => $shift[0],
                    'employee' => $shift[1],
                    'employer' => $shift[2],
                    'hours' => $shift[3],
                    'rate_per_hour' => substr($shift[4], 2),
                    'taxable' => $shift[5] === 'yes' ? true : false,
                    'status' => $shift[6],
                    'shift_type' => $shift[7],
                    'paid_at' => $shift[8] === '' ? null : $shift[8]  
                ];
            }else{
                $firstLoop = false;
            }
        }

        foreach(array_chunk($shiftsArray, 1000) as $data){
            Employee::insert($data);
        }

        fclose($shiftsFile);

        return redirect()->back();
    }

}
