<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateAccountRequest extends Request
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
        $userId = $this->route()->getParameter('id');
        return [
            'email' => 'required|email|max:255|unique:users,email,'.$userId,
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
            'email.unique' => trans('errors.email_has_existed'),
        ];
    }
}
