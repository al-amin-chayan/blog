<?php

namespace App\Http\Requests;

class CommentRequest extends Request
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
            'details' => 'required|max:255'
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

        $input['details'] = filter_var($input['details'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}
