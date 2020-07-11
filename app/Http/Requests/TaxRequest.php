<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
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
        return [
            'tax.title' => 'required|max:255',
            'tax.value' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'tax.title.required' => 'Tax title is required',
            'tax.value.required'  => 'Tax Value is required',
            'tax.value.min'  => 'Tax Value must be at least 0',
            'tax.value.max'  => 'Tax Value value may not be greater than 100',
        ];
    }
}
