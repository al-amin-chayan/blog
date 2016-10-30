<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ProfileRequest extends Request
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
        $this->sanitize();

        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'picture' => 'sometimes|image|mimes:jpeg,gif,png',
            'web' => 'url',
            'facebook' => 'url',
            'twitter' => 'url',
            'github' => 'url',
        ];
    }

    /**
     * Sanitize inputs before validation.
     *
     * @return array
     */
    public function sanitize()
    {
        $this->merge(array_map('trim', $this->all()));

        $input = $this->all();

        $this->replace($input);
    }
}
