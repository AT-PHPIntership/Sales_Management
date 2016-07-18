<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\User;

class UserRequest extends Request
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
            'name' => 'required|max:100',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|max:32|min:6|confirmed',
            'password_confirmation' => 'required|max:32|min:6',
            'role_id' => 'required|integer|between:2,3',
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
