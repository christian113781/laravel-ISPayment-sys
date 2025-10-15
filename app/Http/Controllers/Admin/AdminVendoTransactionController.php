<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendoTransaction; 
use App\Models\Vendo; 
use Illuminate\Support\Str;

class AdminVendoTransactionController extends Controller
{
    public function index() {
        $transactions = VendoTransaction::with('vendo')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.vendo_transaction', compact('transactions'));
    }

    public function vendo() {
    
        return $this->belongsTo(Vendo::class);
    }
}
