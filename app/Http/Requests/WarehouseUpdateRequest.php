<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseUpdateRequest extends FormRequest
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
            'capacity' => 'required|numeric',
            'surface_area' => 'required|numeric',
            'building_area' => 'required|numeric',
            'country_id' => 'required',
            'city' => 'required',
            'zip_code' => 'required|numeric',
            'address' => 'required',
            'warehouse_category_id' => 'required',
            'description' => 'nullable',
            'storage_shelves' => 'required|numeric',
            'goods_handling_equipment' => 'nullable',
            'effective_lighting_system' => 'required',
            'advanced_security_system' => 'required',
            'toilet_and_rest_area' => 'required|numeric',
            'electricity' => 'required',
            'administrative_room_or_office' => 'required',
            'worker_safety_equipment' => 'required',
            'firefighting_tools' => 'required'
        ];
    }
}
