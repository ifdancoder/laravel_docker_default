<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class EquipmentType extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'equipment_type_name',
        'serial_number_mask'
    ];

    public function toSearchableArray()
    {
        return [
            'equipment_type_name' => $this->equipment_type_name,
        ];
    }

    public function equipments() {
        return $this->hasMany(Equipment::class);
    }
}
