<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Product;
use App\Models\Bill;

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
        $rules = ['product_id.*' => 'required|exists:products,id'];
        $products = Product::find($this->input('product_id.*'));
        $totalCost = 0;
        for ($i=0; $i < count($products); $i++) {
            $rules['amount.'. $i] = 'required|numeric|min:1|max:'. $products[$i]->remaining_amount;
            $totalCost += $this->input('amount.'. $i) * $products[$i]->price;
        }
        switch ($this->method()) {
            case 'POST':
                $rules['total_cost'] = 'required|numeric|between:'. $totalCost .','. $totalCost;
                return $rules;
            case 'PUT':
                $currentCost = Bill::find($this->route()->bill)->total_cost;
                $rules['total_cost'] = 'required|numeric|between:'. ($totalCost +$currentCost) .','. ($totalCost +$currentCost);
                return $rules;
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
            'total_cost.required' => trans('errors.total_cost'),
            'total_cost.between' => trans('errors.total_cost_not_match'),
            'product_id.required' => trans('errors.field_required'),
            'product_id.exists' => trans('errors.id_product'),
        ];
    }
}
