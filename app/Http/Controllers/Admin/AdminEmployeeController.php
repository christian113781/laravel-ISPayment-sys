<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class AdminEmployeeController extends Controller
{
    public function index()
    {
        // Use plural variable name to match compact in view
        $employees = Employee::orderBy('created_at', 'desc')->get();
        return view('admin.pages.employee', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',  // salary must be numeric
        ]);

        Employee::create([
            'name'   => $request->name,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Employee added successfully!');
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee->update([
            'name'   => $request->name,
            'salary' => $request->salary,
        ]);

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Employee updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Employee deleted successfully!');
    }
}
