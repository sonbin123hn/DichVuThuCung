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
            'phone' => 'required|numeric|min:10',
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|max:15',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là trường bắt buộc', 
            'phone.required' => 'Số điện thoại là trường bắt buộc', 
            'phone.numeric' => 'Nhập sai định dạng', 
            'phone.min' => 'Số điện thoại có ít nhất 10 số', 
            'email.required' => 'Email là trường bắt buộc', 
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc', 
        ];
    }

    public function getData()
    {
        $data = $this->only(['name','phone', 'email', 'password']);
        return $data;
    }
}
