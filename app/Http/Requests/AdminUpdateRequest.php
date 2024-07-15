<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
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
        $adminId = $this->route('admin');

        return [
            'name' => ['required', 'min:6', 'max:255'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('admins')->ignore($adminId)],
            'phone' => ['required', 'numeric', Rule::unique('admins')->ignore($adminId)],
            'pob' => ['required'],
            'dob' => ['required', 'date'],
            'address' => ['required']
        ];
    }
}
