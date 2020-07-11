<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageRequest extends FormRequest
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
            'language' => 'required|string|max:255|unique:languages',
            'iso_code' => 'required|string|max:3|unique:languages',
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['language'] = Rule::unique('languages')->ignore($this->route('language'));
            $rules['iso_code'] = Rule::unique('languages')->ignore($this->route('language'));
        }

        return $rules;
    }
}
