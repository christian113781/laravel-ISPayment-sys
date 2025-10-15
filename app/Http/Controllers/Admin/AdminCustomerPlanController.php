<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Str;


class AdminCustomerPlanController extends Controller
{
    public function index() {
        $plans = Plan::orderBy('created_at', 'desc')->get();
        return view('admin.pages.customer_plan', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', 
        ]);

        Plan::create([
            'name' => Str::upper($request->name),
            'price' => $request->price,
        ]);

        return redirect()->back()->with('sweet_alert_success', 'Plan added successfully!');
    }

    public function update(Request $request, Plan $plan)
{
    $request->validate([

        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    $plan->update([
        'name' => $request->name,
        'price' => $request->price,

    ]);

    return redirect()->back()->with('sweet_alert_success', 'Plan updated successfully!');
}
public function destroy(Plan $plan)
{
    $plan->delete();

    return redirect()->back()->with('sweet_alert_success', 'Plan deleted successfully!');
}
}
