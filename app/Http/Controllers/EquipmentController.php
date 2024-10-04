<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentArrayRequest;
use App\Http\Requests\EquipmentSearchRequest;

use App\Services\EquipmentService;

class EquipmentController
{
    private $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(EquipmentSearchRequest $request)
    {
        return $this->equipmentService->index($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EquipmentArrayRequest $request)
    {
        $result = $this->equipmentService->create($request);

        if ($result && array_key_exists('errors', $result)) {
            return response()->json((object) $result, 500);
        }
        return response()->json((object) $result, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $result = $this->equipmentService->show($id);

        if ($result) {
            return response()->json((object) $result, 200);
        }
        return response()->json('Запись данного оборудования не была найдена', 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EquipmentUpdateRequest $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $result = $this->equipmentService->destroy($id);

        if ($result) {
            return response()->json('Запись данного оборудования была удалена', 200);
        }
        return response()->json('Запись данного оборудования не была найдена', 500);
    }
}
