<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
                    'name' => 'required|max:50|unique:categories,name,' . $this->category,
                    'description' => 'max:100'
                ];
            case 'POST':
                return [
                    'name' => 'required|max:50|unique:categories',
                    'description' => 'max:100'
                ];
            default:
                return [];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => trans('categories.common.category_exists')
        ];
    }
}
