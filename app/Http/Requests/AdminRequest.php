<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:255',
            'email' => 'required|email:rfc,dns|unique:admins,email|unique:tenants,email',
            'phone' => 'required|numeric|unique:admins,phone|unique:tenants,phone',
            'pob' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'admin_image' => 'file|image'
        ];
    }
}
