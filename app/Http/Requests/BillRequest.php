<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BillRequest extends Request
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
            'total_cost' => 'required|numeric|min:1',
            'product_id.*' => 'required|exists:products,id',
            'amount.*' => 'required|numeric|min:1',
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
            'total_cost.required' => trans('errors.total_cost'),
            'product_id.required' => trans('errors.field_required'),
            'product_id.exists' => trans('errors.id_product'),
        ];
    }
}
