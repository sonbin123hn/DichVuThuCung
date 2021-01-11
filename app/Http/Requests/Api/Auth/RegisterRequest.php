<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|max:15|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên đầy đủ là trường bắt buộc', 
            'email.required' => 'Email là trường bắt buộc', 
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc', 
            'password.confirmed' =>'Mật khẩu xác nhận không khớp với mật khẩu đã nhập',
            'password_confirmation.required' => 'Mật khẩu xác nhận là trường bắt buộc',
        ];
    }

    public function getData()
    {
        $data = $this->only(['name', 'email', 'password']);
        return $data;
    }
}
