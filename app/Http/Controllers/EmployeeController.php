<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use DB;

class EmployeeController extends Controller
{

    public function index(){

        $employees = Employee::select('employee')->distinct()->simplePaginate(15);
        
        return view('employees.index', compact('employees'));

    }

    public function detailed_view($employee_name){

        $lastCompletedPayments = Employee::where('employee',$employee_name)->where('status', "Complete")->orderBy('paid_at', 'desc')->take(5)->get();
        $employeeInfo = Employee::where('employee',$employee_name)->select('employee',DB::raw('AVG(rate_per_hour) as average_rate_per_hour'), DB::raw('AVG(rate_per_hour * hours) as average_total_pay'))->groupBy('employee')->first();
        
        return view('employees.detailed_employee',compact('lastCompletedPayments','employeeInfo'));

    }

}
