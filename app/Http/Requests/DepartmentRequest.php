<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
            'department.title' => ['required','string','max:255','unique:departments,title'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['department.title'] = ['required','string','max:255',Rule::unique('departments', 'title')->ignore($this->route('department'))];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'department.title.required' => 'Department name is required',
            'department.title.unique' => 'Department name is already exists',
        ];
    }
}
