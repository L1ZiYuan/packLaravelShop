<?php

namespace Pack\LaravelShops\Request;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            //
            'auth_name' => 'required',
            'auth_c'    => 'required',
            'auth_a'    => 'required',
            'auth_route'    => 'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'auth_name.required' => 'A auth_name is required',
            'auth_name.max' => 'A auth_name is max 3',
            'auth_c.required'  => 'A auth_c is required',
            'auth_a.required'  => 'A auth_a is required',
            'auth_route.required'  => 'A auth_route is required',
        ];
    }
}
