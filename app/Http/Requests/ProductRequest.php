<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Product;

class ProductRequest extends Request
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
            'name' => 'required|string|min:3|unique:products',
            'price' => 'required|integer|min:1',
            'description' => 'string|min:6|max:200',
            'category_id' => 'required|exists:categories,id',
            'is_on_sale' => 'required|string|between:0,1',

        ];
    }

    /**
     * Get the error messages for the password confirmation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password_confirmation.confirmed' => trans('errors.passwords_not_match'),
            'role_id.integer' => trans('errors.invalid_role'),
            'role_id.between' => trans('errors.invalid_role'),
            'role_id.required' => trans('errors.invalid_role'),
        ];
    }
}
