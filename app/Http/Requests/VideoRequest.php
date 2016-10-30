<?php

namespace App\Http\Requests;

class VideoRequest extends Request
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
            'provider' => 'required',
            'title' => 'required|max:255',
            'source' => 'required|active_url|max:150|unique:videos,source,'.$this->segment(3),
            'display' => 'required',
            'gallery_ids' => 'sometimes|array',
        ];
    }

    /**
     * Sanitize inputs before validation.
     *
     * @return array
     */
    public function sanitize()
    {
        $this->merge(array_map('trim', $this->except('gallery_ids', 'tag_ids')));

        $input = $this->all();

        $input['title'] = filter_var($input['title'], FILTER_SANITIZE_STRING);
        $input['summary'] = filter_var($input['summary'], FILTER_SANITIZE_STRING);

        $this->replace($input);
    }
}