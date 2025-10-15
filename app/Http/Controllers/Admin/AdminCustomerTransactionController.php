<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerTransaction; 
use App\Models\Customer; 
use Illuminate\Support\Str;

class AdminCustomerTransactionController extends Controller
{
    public function index() {
        $transactions = CustomerTransaction::with('customer')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.customer_transaction', compact('transactions'));
    }

    public function customer() {
    
        return $this->belongsTo(Customer::class);
    }
}
