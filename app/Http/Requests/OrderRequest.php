<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
                    'product_id.*' => 'required|exists:products,id',
                    'amount.*' => 'required|numeric|min:1',
                    'supplier_id' => 'required|exists:suppliers,id',
                    'total_cost' => 'required|numeric|min:1',
                ];
            case 'POST':
                return [
                    'product_id.*' => 'required|exists:products,id',
                    'amount.*' => 'required|numeric|min:1',
                    'supplier_id' => 'required|exists:suppliers,id',
                    'total_cost' => 'required|numeric|min:1',
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
            'product_id.*.exists' => trans('orders.common.invalid_product'),
            'amount.*.numeric' => trans('validation.numeric', ['attribute' => 'amount']),
        ];
    }
}
