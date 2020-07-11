<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpenseCategoryRequest extends FormRequest
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
            'category.name' => ['required','string','max:255','unique:expense_categories,name'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['category.name'] = ['required', Rule::unique('expense_categories', 'name')->ignore($this->route('expense_category'))];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'category.name.required' => 'Category name is required',
            'category.name.unique' => 'Category name is already exists',
        ];
    }
}
