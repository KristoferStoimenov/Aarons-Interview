<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $employee = new Employee();
        $statuses = $employee->getStatuses();
        $shiftTypes = $employee->getShiftTypes();

        return [
            'employee' => 'required',
            'employer' => 'required',
            'hours' => 'required',
            'rate_per_hour' => 'required',
            'status' => ['required', Rule::in($statuses)],
            'shift_type' => ['required', Rule::in($shiftTypes)],
            'date' => 'required|date',
            'paid_at' => 'required|date'
        ];
    }
}
