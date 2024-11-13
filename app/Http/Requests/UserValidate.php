<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:20|min:3',
            'last_name' => 'required|max:20|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:10',
            'phone' => 'required|integer|digits:10',
            // 'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
            'phone.required' => 'The phone number is required.',
            // 'image.nullable' => 'Select valid image'
        ];
    }
}