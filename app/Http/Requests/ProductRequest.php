<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category_id' => 'required|numeric',
            'purchase_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'tax_id' => 'required|numeric',
            'price_type' => 'required|numeric',
        ];

        if ($this->getMethod() == 'PATCH') {
            $rules['sku'] = Rule::unique('products')->ignore($this->route('product'));
        }

        return $rules;
    }
}
