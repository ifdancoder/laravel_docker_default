<?php

namespace App\Http\Controllers;

use App\Models\EquipmentType;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentTypeRequest;
use App\Http\Requests\EquipmentTypeSearchRequest;

use App\Services\EquipmentTypeService;

class EquipmentTypeController
{
    private $equipmentTypeService;

    public function __construct(EquipmentTypeService $equipmentTypeService)
    {
        $this->equipmentTypeService = $equipmentTypeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentTypeSearchRequest $request)
    {
        $equipmentTypes =  $this->equipmentTypeService->index($request->validated());

        if (!$equipmentTypes) {
            return response()->json($equipmentTypes, 500);
        }
        return response()->json($equipmentTypes, 200);
    }

    public function store(EquipmentTypeRequest $request)
    {
        $created = $this->equipmentTypeService->create($request->validated());
        
        if (!$created) {
            return response()->json('Тип оборудования не был создан', 500);
        }
        return response()->json($created, 200);
    }

    public function destroy(int $id)
    {
        $result = $this->equipmentTypeService->destroy($id);

        if ($result) {
            return response()->json('Запись данного типа оборудования была удалена', 200);
        }
        return response()->json('Запись данного типа оборудования не была найдена', 500);
    }
}
