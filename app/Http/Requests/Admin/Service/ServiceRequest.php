<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric',
        ];
    }
    public function messages()
    {
        $messages = [
            'service_name.required' => 'Service name is required field',
            'detail.required' => 'Detail is required field',
            'price.required' => 'Price is required field',
            'price.numeric' => 'Price is must be numeric',
        ];
        return $messages;
    }
}
