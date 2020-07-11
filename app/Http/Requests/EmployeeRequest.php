<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
     * @return array
     */

    public function rules()
    {
        $rules = [
            'name' => ['required','string'],
            'department_id' => ['required','numeric'],
            'designation_id' => ['required','numeric'],
            'branch_id' => ['required','numeric'],
            'role' => ['required'],
            'email' => ['required','string','max:255','unique:users'],
        ];


        if ($this->getMethod() == 'PATCH') {
            $employee = Employee::findOrFail($this->route('employee'));
            $rules['email'] = Rule::unique('users')->ignore($employee->user_id);
        }

        return $rules;
    }
}
