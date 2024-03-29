<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PasswordChangeRequest extends Request
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
            'password' => 'required',
            'new_password' => 'required|min:1|confirmed|different:password',
            'new_password_confirmation' => 'required_with:new_password'
        ];
    }
}
