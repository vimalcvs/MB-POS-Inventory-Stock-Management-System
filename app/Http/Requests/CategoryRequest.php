<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'category.title' => ['required','string','max:255','unique:categories,title'],
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['category.title'] = ['required', 'string','max:255', Rule::unique('categories', 'title')->ignore($this->route('category'))];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'category.title.required' => 'Category name is required',
            'category.title.unique' => 'Category name is already exists',
        ];
    }
}
