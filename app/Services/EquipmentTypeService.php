<?php
namespace App\Services;

use App\Models\EquipmentType;

use App\Http\Resources\EquipmentTypeResource;
use App\Http\Resources\EquipmentTypeCollection;

class EquipmentTypeService
{
    public function index($data)
    {
        $query = null;
        if (array_key_exists('q', $data) && $data['q'] != '') {
            $query = EquipmentType::search($data['q']);
        } else {
            $query = EquipmentType::query();
            if (array_key_exists('name', $data)) {
                $query = $query->where('name', 'like', '%'.$data['name'].'%');
            }
        }

        if (array_key_exists('perPage', $data)) {
            $perPage = $data['perPage'];
            $query = $query->paginate($perPage);
        }
        else {
            $query = $query->get();
        }

        return new EquipmentTypeCollection($query);
    }
    public function create(array $data)
    {
        $createdEquipmentType = EquipmentType::create($data);

        if (!$createdEquipmentType) {
            return null;
        }
        return new EquipmentTypeResource($createdEquipmentType);
    }
    public function destroy(int $id)
    {
        $equipmentType = EquipmentType::find($id);
        
        if (!$equipmentType) {
            return null;
        }
        $createdEquipmentType = $equipmentType->delete();
        return $createdEquipmentType;
    }
    public function show($id) 
    {
        $equipmentType = EquipmentType::find($id);
        if (!$equipmentType) {
            return null;
        }
        return new EquipmentTypeResource($equipmentType);
    }
}