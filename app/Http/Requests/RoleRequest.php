<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'role.name' => ['required','string','min:2','max:255','unique:roles,name'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['role.name.unique'] = Rule::unique('roles', 'name')->ignore($this->route('role'));
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'role.name.required' => 'Role Name is required',
            'role.name.unique' => 'Role Name is already exists',
        ];
    }
}
