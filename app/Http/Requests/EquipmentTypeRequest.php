<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentTypeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equipment_type_name' => 'required|string',
            'serial_number_mask' => 'required|regex:/^[NAaXZ]*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'equipment_type_name.required' => 'Название типа оборудования обязательно',
            'serial_number_mask.required' => 'Маска серийного номера обязательна',
            'serial_number_mask.regex' => 'Маска серийного номера должна состоять из латинских букв N, A, a, X, Z',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
