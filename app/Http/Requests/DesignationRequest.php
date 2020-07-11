<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DesignationRequest extends FormRequest
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
            'designation.title' => ['required','string','max:255','unique:designations,title'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['designation.title'] = ['required','string','max:255',Rule::unique('designations', 'title')->ignore($this->route('designation'))];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'designation.title.required' => 'Designation name is required',
            'designation.title.unique' => 'Designation name is already exists',
        ];
    }
}
