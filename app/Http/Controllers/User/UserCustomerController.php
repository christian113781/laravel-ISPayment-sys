<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Area;
use App\Models\Customer;
use App\Models\CustomerTransaction; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserCustomerController extends Controller
{
    public function index() {
    $plans = Plan::all();
    $areas = Area::all();
    $customers = Customer::with(['plan','area'])->get(); 
    return view('user.pages.customer_manage', compact('plans','areas','customers'));
}

    public function store(Request $request)
    {
        $request->validate([
            'addName'   => 'required|string|max:255',
            'plan_id'   => 'required|exists:plans,id',
            'area_id'   => 'required|exists:areas,id',
            'addLPD'    => 'required|date',
            'addAddress'=> 'nullable|string',
        ]);

        Customer::create([
            'name'      => Str::upper($request->addName),
            'plan_id'   => $request->plan_id,
            'area_id'   => $request->area_id,
            'lpd'        => $request->addLPD,
            'address'   => Str::upper($request->addAddress),
        ]);

        return redirect()->back()->with('sweet_alert_success', 'Customer added successfully!');
        }
        public function destroy(Customer $customer)
        {
        $customer->delete();

        return redirect()->back()->with('sweet_alert_success', 'Customer deleted successfully!');
        }


    public function update(Request $request, Customer $customer)
    {
    $request->validate([
        'addName' => 'required|string|max:255',
        'plan_id' => 'required|exists:plans,id',
        'area_id' => 'required|exists:areas,id',
        'addLPD'  => 'required|date',
        'addAddress' => 'nullable|string',
    ]);

    $customer->update([
        'name' => Str::upper($request->addName),
        'plan_id' => $request->plan_id,
        'area_id' => $request->area_id,
        'lpd' => $request->addLPD,
        'address' => Str::upper($request->addAddress),
    ]);

    return redirect()->back()->with('sweet_alert_success', 'Customer updated successfully!');
    }


    public function paymentInfo($id)
    {
    $customer = Customer::with('area', 'plan')->findOrFail($id);

    return response()->json([
        'customer' => [
            'id' => $customer->id,
            'name' => $customer->name,
            'area' => $customer->area->name ?? '',
            'plan_name' => $customer->plan->name ?? '',
            'price' => $customer->plan->price ?? '',
            'lpd' => $customer->lpd ? $customer->lpd->format('Y-m-d') : '',
        ]
    ]);
}

    public function generateReceipt()
{
    // Get the next CustomerTransaction ID
    $maxId = CustomerTransaction::max('id');
    $nextId = $maxId ? $maxId + 1 : 1;

    // Format: RCPT-250906-00001
    $receiptNumber = 'RCPT-' . now()->format('ymd') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

    return response()->json(['receipt_number' => $receiptNumber]);
}

public function storeTransaction(Request $request)
{
    try {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric', 
            'addPaymentMethod' => 'required|string',
            'addRemarks' => 'nullable|string',
            'customerPicture' => 'nullable|image|max:2048',
            'addLPD' => 'required|date',
        ]);

        $customer = Customer::findOrFail($request->customer_id);

        // Update LPD and DD for customer
        $customer->update([
            'lpd' => $request->addLPD,
        ]);

        $transaction = new CustomerTransaction();
        $transaction->customer_id = $customer->id;
        $transaction->amount = $request->amount; 
        $transaction->payment_method = $request->addPaymentMethod;
        $transaction->remarks = $request->addRemarks ?? '';

        if ($request->hasFile('customerPicture')) {
            $transaction->receipt_image = $request->file('customerPicture')->store('receipts', 'public');
        }

        $maxId = CustomerTransaction::max('id') ?? 0;
        $nextId = $maxId + 1;
        $transaction->receipt_number = 'RCPT-' . now()->format('ymd') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction saved and customer updated!',
            'receipt' => $transaction->receipt_number
        ]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}
}
