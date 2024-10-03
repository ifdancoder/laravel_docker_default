<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use App\Models\Equipment;
use App\Models\EquipmentType;

class EquipmentValidator
{
    private $errors = [];

    /**
     * Валидация данных для оборудования.
     *
     * @param array $data
     * @return bool
     */
    public function validate(array $data): bool
    {
        $validator = Validator::make($data, [
            'equipment_type_id' => 'required|exists:equipment_types,id',
            'serial_number' => 'required|string',
            'description' => 'nullable|string',
        ], [
            'equipment_type_id.required' => 'Необходимо указать тип оборудования',
            'equipment_type_id.exists' => 'Указанного типа оборудования не существует',
            'equipment_type_id.integer' => 'Тип оборудования был передан неправильно',
            'serial_number.required' => 'Маска серийного номера обязательна',
            'serial_number.string' => 'Маска серийного номера должна быть представлена строкой',
            'description.string' => 'Описание должно быть представлено строкой',
        ]);

        $validator->after(function ($validator) use ($data) {
            $equipmentTypeId = $data['equipment_type_id'];
            $serialNumber = $data['serial_number'];

            // Проверка на наличие существующего оборудования с данным типом и серийным номером
            if (Equipment::where('equipment_type_id', $equipmentTypeId)->where('serial_number', $serialNumber)->exists()) {
                $validator->errors()->add('equipment_type_id', 'Модель оборудования указанного типа с указанным серийным номером уже существует');
            }

            $equipmentType = EquipmentType::find($equipmentTypeId);
            if (is_null($equipmentType)) {
                $validator->errors()->add('serial_number', 'Проверка серийного номера на соответствие маске невозможна ввиду некорректно указанного типа оборудования');
            } else {
                // Проверка соответствия серийного номера маске
                $associative_array = [
                    'N' => '[0-9]',
                    'A' => '[A-Z]',
                    'a' => '[a-z]',
                    'X' => '[A-Z0-9]',
                    'Z' => '[-_@]'
                ];
                $pattern = '';
                $mask = $equipmentType->serial_number_mask;

                for ($i = 0; $i < strlen($mask); $i++) {
                    $pattern .= $associative_array[$mask[$i]] ?? '';
                }

                if (!preg_match('/^' . $pattern . '$/', $serialNumber)) {
                    $validator->errors()->add('serial_number', 'Серийный номер не соответствует маске типа оборудования');
                }
            }
        });

        // Если валидация не прошла, сохраняем ошибки в $this->errors
        if ($validator->fails()) {
            $this->errors = $validator->errors()->all();
            return false;
        }

        return true;
    }

    /**
     * Возвращает ошибки валидации.
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
