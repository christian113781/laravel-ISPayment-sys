<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Expense;
use Carbon\Carbon;

class AdminExpensesController extends Controller
{
    public function index()
    {   
        $expenses = \App\Models\Expense::orderBy('expenses_date', 'desc')->get();
        return view('admin.pages.expenses', compact('expenses'));
    }

    public function store(Request $request)
{
    $request->validate([
        'expenses_date'   => 'required|date',
        'type'            => 'required|string|max:255',
        'amount'          => 'required|numeric',
        'description'     => 'required|string',
        'receipt_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

     // Convert date to MySQL format
    $expensesDate = Carbon::parse($request->datepicker)->format('Y-m-d');

    $data = [
        'expenses_date' => $expensesDate,
        'type'          => Str::upper($request->type), // convert to uppercase
        'amount'        => $request->amount,
        'description'   => Str::upper($request->description ?? ''),
    ];

    // Handle receipt image upload
    if ($request->hasFile('receipt_image')) {
        $file = $request->file('receipt_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/expenses', $filename);
        $data['receipt_image'] = 'expenses/' . $filename;
    }

    \App\Models\Expense::create($data);

    return redirect()->back()->with('sweet_alert_success', 'Expense added successfully!');
}
public function destroy(\App\Models\Expense $expense)
{
    // Delete the receipt image from storage if exists
    if ($expense->receipt_image && \Storage::exists('public/' . $expense->receipt_image)) {
        \Storage::delete('public/' . $expense->receipt_image);
    }

    // Delete the expense record
    $expense->delete();

    return redirect()->back()->with('sweet_alert_success', 'Expense deleted successfully!');
}

public function update(Request $request, Expense $expense)
{
    $request->validate([
        'type'           => 'required|string|max:255',
        'amount'         => 'required|numeric',
        'expenses_date'  => 'required|date',
        'description'    => 'required|string',
        'receipt_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Convert date to MySQL format
    $expensesDate = \Carbon\Carbon::parse($request->expenses_date)->format('Y-m-d');

    $data = [
        'type'          => \Str::upper($request->type),
        'amount'        => $request->amount,
        'expenses_date' => $expensesDate,
        'description'   => \Str::upper($request->description),
    ];

    // Handle receipt image upload
    if ($request->hasFile('receipt_image')) {
        $file = $request->file('receipt_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/expenses', $filename);
        $data['receipt_image'] = 'expenses/' . $filename;
    }

    $expense->update($data);

    return redirect()->back()->with('sweet_alert_success', 'Expense updated successfully!');
}
}
