<?php
namespace App\Services;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\EquipmentCollection;
use App\Models\Equipment;
use App\Http\Requests\EquipmentRequest;
use App\Validators\EquipmentValidator;

class EquipmentService
{

    public function index($data)
    {
        $query = null;
        if (array_key_exists('q', $data) && $data['q'] != '') {
            $query = Equipment::search($data['q']);
        } else {
            $query = Equipment::query();
            if (array_key_exists('serial_number', $data)) {
                $query = $query->where('serial_number', 'like', '%'.$data['serial_number'].'%');
            }
            if (array_key_exists('description', $data)) {
                $query = $query->where('description', 'like', '%'.$data['description'].'%');
            }
        }

        if (array_key_exists('perPage', $data)) {
            $perPage = $data['perPage'];
            $query = $query->paginate($perPage);
        }
        else {
            $query = $query->get();
        }

        return new EquipmentCollection($query);
    }

    public function create(Request $request)
    {
        $equipments = $request->input('equipments');
        $validatedEquipments = [];
        $errors = [];

        foreach ($equipments as $key => $equipment) {
            $validator = new EquipmentValidator();
            $result = $validator->validate($equipment);
            if ($result) {
                $validatedEquipments[$key] = $equipment;
            } else {
                $errors[$key] = $validator->errors();
            }
            unset($validator);
        }
        
        $success = [];
        foreach ($validatedEquipments as $key => $equipment) {
            $created = Equipment::create($equipment);
            if ($created) {
                $success[$key] = $created;
            } else {
                $errors[$key] = 'Failed to create equipment';
            }
            unset($validatedEquipments[$key]);
        }

        return ['success' => $success, 'errors' => $errors];
    }

    public function update(Equipment $equipment, array $data)
    {
        $equipment->update($data);
        return $equipment;
    }

    public function destroy(int $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return null;
        }
        $createdEquipment = $equipment->delete();
        return $createdEquipment;
    }

    public function find($id)
    {
        return Equipment::find($id);
    }
}