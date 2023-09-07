<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all(); // Obtener todos los departamentos desde la base de datos.

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        $institutions = Institution::all(); // Obtener todas las instituciones
        // Obtén la lista de usuarios que tienen al menos una adscripción
        $users = User::whereIn('id', function($query) {
            $query->select('user_id')
                ->from('adscriptions')
                ->distinct();
        })->get();

        return view('departments.create', compact('institutions', 'users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'institution_id' => ['required', 'exists:institutions,id'],
            'responsible_id' => [
                'required',
                'exists:users,id',
                Rule::unique('departments', 'responsible_id')->where(function ($query) use ($request) {
                    return $query->where('institution_id', $request->input('institution_id'));
                })
            ],
        ];
    
        $messages = [
            'name.required' => 'El nombre del departamento es requerido.',
            'name.string' => 'El nombre del departamento debe ser una cadena de texto.',
            'name.max' => 'El nombre del departamento no debe exceder los 255 caracteres.',
            'description.required' => 'La descripción del departamento es requerida.',
            'description.string' => 'La descripción del departamento debe ser una cadena de texto.',
            'institution_id.required' => 'La institución es requerida.',
            'institution_id.exists' => 'La institución seleccionada no existe.',
            'responsible_id.required' => 'El responsable del departamento es requerido.',
            'responsible_id.exists' => 'El responsable seleccionado no existe.',
            'responsible_id.unique' => 'Este responsable ya está asignado a otro departamento de la misma institución.',
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        Department::create($validatedData);
    
        return redirect()->route('departments.index')->with('success', 'El departamento se ha creado exitosamente.');
    }
    

    public function edit(Department $department)
    {
        $institutions = Institution::all();
        $users = User::whereIn('id', function($query) {
            $query->select('user_id')
                ->from('adscriptions')
                ->distinct();
        })->get();

        return view('departments.edit', compact('department','institutions', 'users'));
    }

    public function update(Request $request, Department $department)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'institution_id' => ['required', 'exists:institutions,id'],
            'responsible_id' => [
                'required',
                'exists:users,id',
                Rule::unique('departments', 'responsible_id')->where(function ($query) use ($request, $department) {
                    return $query->where('institution_id', $request->input('institution_id'))
                                 ->where('id', '!=', $department->id);
                })
            ],
        ];
    
        $messages = [
            'name.required' => 'El nombre del departamento es requerido.',
            'name.string' => 'El nombre del departamento debe ser una cadena de texto.',
            'name.max' => 'El nombre del departamento no debe exceder los 255 caracteres.',
            'description.required' => 'La descripción del departamento es requerida.',
            'description.string' => 'La descripción del departamento debe ser una cadena de texto.',
            'institution_id.required' => 'La institución es requerida.',
            'institution_id.exists' => 'La institución seleccionada no existe.',
            'responsible_id.required' => 'El responsable del departamento es requerido.',
            'responsible_id.exists' => 'El responsable seleccionado no existe.',
            'responsible_id.unique' => 'Este responsable ya está asignado a otro departamento de la misma institución.',
        ];
    
        $validatedData = $request->validate($rules, $messages);
    
        $department->update($validatedData);
    
        return redirect()->route('departments.index')->with('success', 'El departamento se ha actualizado exitosamente.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'El departamento se ha eliminado exitosamente.');
    }
}
