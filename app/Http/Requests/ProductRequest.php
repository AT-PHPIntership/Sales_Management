<?php

namespace App\Http\Requests;

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
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                  'name' => 'required|string|min:2',
                  'price' => 'required|integer|min:1',
                  'description' => 'string|max:255',
                  'category_id' => 'required|exists:categories,id',
                ];
            case 'POST':
                return [
                  'name' => 'required|string|min:2|unique:products',
                  'price' => 'required|integer|min:1',
                  'description' => 'string|max:255',
                  'category_id' => 'required|exists:categories,id',
                ];
            default:
                return [];
        }
    }

    /**
     * Get the error messages for the password confirmation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.exists' => trans('errors.invalid_category'),
            'category_id.required' => trans('errors.invalid_category'),
        ];
    }
}
