<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $gender = $request->input('gender');
        $education = $request->input('education');
        $position = $request->input('position');

        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        $allowedSorts = ['created_at', 'birth_date', 'join_date', 'name'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'created_at';
        }
        $sortDirection = $sortDirection === 'asc' ? 'asc' : 'desc';

        $employees = Employee::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('position', 'like', "%{$search}%");
        })
            ->when($gender, fn($q) => $q->where('gender', $gender))
            ->when($education, fn($q) => $q->where('last_education', $education))
            ->when($position, fn($q) => $q->where('position', $position))
            ->orderBy($sortField, $sortDirection)
            ->paginate(8)
            ->withQueryString();

        $positions = Employee::select('position')->distinct()->orderBy('position')->pluck('position');

        return view('employees.index', compact(
            'employees',
            'search',
            'gender',
            'education',
            'position',
            'sortField',
            'sortDirection',
            'positions'
        ));
    }
    public function create()
    {
        return view('employees.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'last_education' => 'required',
            'birth_date' => 'required|date',
            'join_date' => 'required|date',
        ]);

        Employee::create($request->all());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'gender' => 'required',
            'last_education' => 'required',
            'birth_date' => 'required|date',
            'join_date' => 'required|date',
        ]);

        $employee->update($request->all());

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
