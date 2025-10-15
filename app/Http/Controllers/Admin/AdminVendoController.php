<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Vendo;
use Illuminate\Support\Str;
use App\Models\vendoTransaction;

class AdminVendoController extends Controller
{   
    public function index() {

        $areas = Area::all();
        $vendos = Vendo::with(['area'])->get();
        return view('admin.pages.vendo_manage', compact('areas','vendos'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'addName'    => 'required|string|max:255',
            'area_id'    => 'required|exists:areas,id',
            'addLHD'     => 'required|date',
            'addAddress' => 'nullable|string',
            'addKeys'    => 'nullable|string',
            'addShares'  => 'nullable|integer',
            
        ]);

        Vendo::create([
            'name'    => Str::upper($request->addName),
            'area_id' => $request->area_id,
            'lhd'     => $request->addLHD,
            'key'     => $request->addKeys,
            'address' => Str::upper($request->addAddress), 
            'shares'  => $request->addShares, 
        ]);

        return redirect()->back()->with('sweet_alert_success', 'Vendo added successfully!');
    }

    public function destroy(Vendo $vendo)
    {
        $vendo->delete();

        return redirect()->back()->with('sweet_alert_success', 'Vendo deleted successfully!');
    }

    public function update(Request $request, Vendo $vendo)
{
    $request->validate([
        'addName'    => 'required|string|max:255',
        'area_id'    => 'required|exists:areas,id',
        'addLHD'     => 'required|date',
        'addAddress' => 'nullable|string',
        'addKeys'    => 'nullable|string',
        'addShares'  => 'nullable|integer',
    ]);

    $vendo->update([
        'name'    => $request->addName,
        'area_id' => $request->area_id,
        'lhd'     => $request->addLHD,
        'address' => $request->addAddress,
        'key'     => $request->addKeys,
        'shares'  => $request->addShares,
    ]);

    return redirect()->back()->with('sweet_alert_success', 'Vendo updated successfully!');
}


public function storeTransaction(Request $request)
{
    try {
        $request->validate([
            'vendo_id'     => 'required|exists:vendos,id',
            'amount'       => 'required|numeric',
            'addRemarks'   => 'nullable|string',
            'vendoPicture' => 'nullable|image|max:2048',
            'addLHD'       => 'required|date',
]);

        $vendo = Vendo::findOrFail($request->vendo_id);

        // Update vendo LHD
        $vendo->update(['lhd' => $request->addLHD]);

        $transaction = new VendoTransaction();
        $transaction->vendo_id = $vendo->id;
        $transaction->amount   = $request->amount;
        $transaction->remarks  = $request->addRemarks ?? '';

        if ($request->hasFile('vendoPicture')) {
            $transaction->receipt_image = $request->file('vendoPicture')
                ->store('receipts', 'public');
        }

        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction saved and vendo updated!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(),
        ], 500);
    }
}


  public function harvestInfo($id)
    {
    $vendo = Vendo::with('area')->findOrFail($id);

    return response()->json([
        'vendo' => [
            'id' => $vendo->id,
            'name' => $vendo->name,
            'area' => $vendo->area->name ?? '',
            'address' => $vendo->address ?? '',
            'shares' => $vendo->shares ?? '',
            'remarks' => $vendo->remarks ?? '',
            'lhd' => $vendo->lhd ? $vendo->lhd->format('Y-m-d') : '',
        ]
    ]);
}

}