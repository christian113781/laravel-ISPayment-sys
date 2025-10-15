<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Str;

class AdminCustomerAreaController extends Controller
{
    public function index() {
        $areas = Area::orderBy('created_at', 'desc')->get();
        return view('admin.pages.customer_area', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:areas,code',
            'name' => 'required|string|max:255',
        ]);

        Area::create([
            'code' => Str::upper($request->code),
            'name' => Str::upper($request->name),
        ]);

        return redirect()->back()->with('sweet_alert_success', 'Area added successfully!');
    }

    public function update(Request $request, Area $area)
{
    $request->validate([
        'code' => 'required|string|max:50',
        'name' => 'required|string|max:255',
    ]);

    $area->update([
        'code' => $request->code,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('sweet_alert_success', 'Area updated successfully!');
}
public function destroy(Area $area)
{
    $area->delete();

    return redirect()->back()->with('sweet_alert_success', 'Area deleted successfully!');
}
}
