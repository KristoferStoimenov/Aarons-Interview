<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest; 
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use DB;


class ShiftController extends Controller
{

    public function index(Request $request){
       
        $shifts = Employee::select('*', DB::raw('rate_per_hour * hours as total_pay'));

        if($request->has('total_pay_filter') && $request->total_pay_filter != null){
            $shifts = $shifts->having('total_pay', '>=', $request->total_pay_filter);
        }

        $shifts = $shifts->simplePaginate(15);
        
        return view('shifts.index', compact('shifts'));
    }

    public function create(){

        $employee = new Employee();
        $statuses = $employee->getStatuses();
        $shiftTypes = $employee->getShiftTypes();

        return view('shifts.create', compact('shiftTypes','statuses'));
    }

    /**
        * @param  \App\Http\Requests\StoreEmployeeRequest  $request
        * @return Illuminate\Http\Response
    */
    public function store(StoreEmployeeRequest $request){
        
        $validated = $request->validated();
        
        Employee::create([
            'employee' => $request->employee,
            'employer' => $request->employer,
            'hours' => $request->hours,
            'rate_per_hour' => $request->rate_per_hour,
            'status' => $request->status,
            'taxable' => $request->has('taxable') ? true : false,
            'shift_type' => $request->shift_type,
            'date' => $request->date,
            'paid_at' => $request->paid_at,
        ]);
        
        return redirect()->route('index.shifts');
        
    }

    public function edit($id){

        $shift = Employee::findOrFail($id);
        $statuses = $shift->getStatuses();
        $shiftTypes = $shift->getShiftTypes();

        return view('shifts.update',compact('shift','statuses','shiftTypes'));
    }

    public function update(StoreEmployeeRequest $request, $id){

        $validated = $request->validated();
        
        Employee::where('id', $id)->update([
            'employee' => $request->employee,
            'employer' => $request->employer,
            'hours' => $request->hours,
            'rate_per_hour' => $request->rate_per_hour,
            'status' => $request->status,
            'taxable' => $request->has('taxable') ? true : false,
            'shift_type' => $request->shift_type,
            'date' => $request->date,
            'paid_at' => $request->paid_at,
        ]);
        
        return redirect()->route('index.shifts');
    }

    public function delete($id){
        $shift = Employee::findOrFail($id);
        $shift->delete();
        return redirect()->route('index.shifts');
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
