<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Equipment extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'equipment_type_id',
        'serial_number',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function toSearchableArray()
    {
        return [
            'serial_number' => $this->serial_number,
            'description' => $this->description,
        ];
    }

    public function equipmentType()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
