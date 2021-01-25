<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'username'          => 'required|unique:users',
            'email'             => 'required|unique:users',
            // 'image'             => 'image',
            'image'             => 'mimes:jpeg,jpg,png,gif|required',
            'password'          => 'required|confirmed',
            'permissions'       => 'required|min:1'
        ];
    }
}
