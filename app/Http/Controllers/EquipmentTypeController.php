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
        return $this->equipmentTypeService->index($request->validated());
    }

    public function store(EquipmentTypeRequest $request)
    {
        $created = $this->equipmentTypeService->create($request->validated());
        
        if ($created) {
            return response()->json(['success' => true, 'message' => 'Тип оборудования был создан'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Тип оборудования не был создан'], 500);
    }

    public function destroy(int $id)
    {
        $result = $this->equipmentTypeService->destroy($id);

        if ($result) {
            return response()->json(['success' => true, 'message' => 'Запись данного типа оборудования была удалена'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Запись данного типа оборудования не была найдена'], 500);
    }
}
