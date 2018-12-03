<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:5|max:191',
            'preview' => 'required|min:5|max:191',
            'body' => 'required|min:5',
            'cover' => 'sometimes',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
