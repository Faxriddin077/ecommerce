<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required|min:3|max:50',
            'name' => 'required|min:3|max:50',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'count' => 'required|numeric|min:1'
        ];
    }
}
