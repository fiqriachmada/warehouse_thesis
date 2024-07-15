<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRegisterRequest extends FormRequest
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
            'username' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'email:rfc,dns', 'unique:tenants'],
            'password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'first_name' => ['required'],
            'phone' => ['required', 'numeric', 'unique:tenants'],
            'npwp' => ['required', 'numeric', 'unique:tenants'],
            // 'pob' => ['required'],
            // 'dob' => ['required', 'date'],
            'address' => ['required']
        ];
    }
}
