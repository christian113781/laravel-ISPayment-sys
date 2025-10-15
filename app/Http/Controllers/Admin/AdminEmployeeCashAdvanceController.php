<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashAdvance;
use App\Models\Employee;

class AdminEmployeeCashAdvanceController extends Controller
{
    public function index()
    {
        // get all cash advances with employee info
        $employeeCashAdvances = CashAdvance::with('employee')->orderBy('created_at', 'desc')->get();
        $employees = Employee::orderBy('name')->get();

        return view('admin.pages.employee_cashAdvance', compact('employeeCashAdvances', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount'      => 'required|numeric|min:0',
            'remarks'     => 'nullable|string|max:255',
            'date'        => 'required|date',
        ]);

        CashAdvance::create([
            'employee_id' => $request->employee_id,
            'amount'      => $request->amount,
            'remarks'     => $request->remarks,
            'date'        => $request->date,
        ]);

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Cash advance recorded successfully!');
    }

    public function update(Request $request, CashAdvance $cashAdvance)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount'      => 'required|numeric|min:0',
            'remarks'     => 'nullable|string|max:255',
            'date'        => 'required|date',
        ]);

        $cashAdvance->update([
            'employee_id' => $request->employee_id,
            'amount'      => $request->amount,
            'remarks'     => $request->remarks,
            'date'        => $request->date,
        ]);

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Cash advance updated successfully!');
    }

    public function destroy(CashAdvance $cashAdvance)
    {
        $cashAdvance->delete();

        return redirect()
            ->back()
            ->with('sweet_alert_success', 'Cash advance deleted successfully!');
    }
}
