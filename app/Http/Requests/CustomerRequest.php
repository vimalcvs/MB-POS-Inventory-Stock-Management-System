<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:customers',
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['phone'] = Rule::unique('customers')->ignore($this->route('customer'));
        }

        return $rules;
    }


}
