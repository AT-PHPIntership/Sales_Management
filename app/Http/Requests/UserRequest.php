<?php

namespace App\Http\Requests;

use App\Models\User;
use Auth;

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
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                return [
                  'name' => 'required|min:4|max:100',
                  'birthday' => 'required|date_format:d/m/Y',
                  'gender' => 'required|boolean',
                  'address' => 'required|max:255',
                  'phone_number' => 'required|max:15|regex:/^\+?\d+?$/',
                  'role_id' => 'required|integer|between:2,3',
                ];
            case 'POST':
                return [
                    'name' => 'required|max:100',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|max:32|min:6|confirmed',
                    'password_confirmation' => 'required|max:32|min:6',
                    'role_id' => 'required|integer|between:2,3',
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
            'password_confirmation.confirmed' => trans('errors.passwords_not_match'),
            'role_id.integer' => trans('errors.invalid_role'),
            'role_id.between' => trans('errors.invalid_role'),
            'role_id.required' => trans('errors.invalid_role'),
        ];
    }
}
