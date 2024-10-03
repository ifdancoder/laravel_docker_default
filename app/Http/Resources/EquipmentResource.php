<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "equipment_type" => [
                "id" => $this->equipment_type_id,
                "name" => $this->equipmentType->equipment_type_name,
                "mask" => $this->equipmentType->serial_number_mask
            ],
            "serial_number" => $this->serial_number,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
