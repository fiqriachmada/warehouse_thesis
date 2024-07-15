<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantUpdateRequest extends FormRequest
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
        $tenantId = $this->route('tenant');

        return [
            'name' => ['required', 'min:6', 'max:255'],
            'npwp' => ['required', Rule::unique('tenants')->ignore($tenantId)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('tenants')->ignore($tenantId)],
            'phone' => ['required', 'numeric', Rule::unique('tenants')->ignore($tenantId)],
            // 'pob' => ['required'],
            // 'dob' => ['required', 'date'],
            'address' => ['required']
        ];
    }
}
