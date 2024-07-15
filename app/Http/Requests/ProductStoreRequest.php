<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required',
            'product_category_id' => 'required',
            'rack_id' => 'required',
            'description' => 'nullable',
            'sale_price' => 'required',
            'weight' => 'required',
            'length' => 'nullable',
            'width' => 'nullable',
            'height' => 'nullable',
            'expired_date' => 'nullable|date',
        ];
    }
}
