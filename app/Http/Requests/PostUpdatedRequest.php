<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdatedRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'user_id' => ['required'],
            'body' => ['required', 'min:30' ],
            'image' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png', 'max:5000'],
        ];
    }
}
