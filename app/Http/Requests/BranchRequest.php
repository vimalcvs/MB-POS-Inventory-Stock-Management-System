<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchRequest extends FormRequest
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
            'title' => 'required|max:255|unique:branches',
            'contact_person' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255'
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['title'] = Rule::unique('branches')->ignore($this->route('branch'));
        }

        return $rules;
    }
}
