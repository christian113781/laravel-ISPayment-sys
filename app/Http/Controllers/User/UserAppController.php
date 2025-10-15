<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerTransaction;
use App\Models\VendoTransaction;
use App\Models\Customer;
use App\Models\Vendo;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserAppController extends Controller
{
    /**
     * Dashboard index showing monthly customer sales report and total customers.
     */
    public function index()
    {
        // Get customer monthly sales totals (sum of amounts per month)
        $customerMonthlySales = $this->getCustomerMonthlySales();
        $vendoMonthlySales = $this->getVendoMonthlySales();
        $expensesMonthlySales = $this->getExpensesMonthlySales();

        // Total income for current month
        $currentCustomerMonthIncome = CustomerTransaction::whereYear('created_at', now()->year)
                                         ->whereMonth('created_at', now()->month)
                                         ->sum('amount');
        // Total income for current month
        $currentVendoMonthIncome = VendoTransaction::whereYear('created_at', now()->year)
                                         ->whereMonth('created_at', now()->month)
                                         ->sum('amount');    
         // Total income for current month
        $currentExpensesMonthIncome = Expense::whereYear('created_at', now()->year)
                                         ->whereMonth('created_at', now()->month)
                                         ->sum('amount');                              
        // Total sales for all customers
        $totalCustomerSales = CustomerTransaction::sum('amount');
        $totalVendoSales = VendoTransaction::sum('amount');
        $totalExpensesSales = Expense::sum('amount');
        // Total number of unique customers
        $totalCustomers = Customer::count();
        $totalVendos = Vendo::count();

        return view('user.pages.dashboard', compact('totalExpensesSales','currentExpensesMonthIncome','customerMonthlySales','vendoMonthlySales','expensesMonthlySales', 'totalCustomers','totalVendos', 'currentCustomerMonthIncome','currentVendoMonthIncome','totalCustomerSales','totalVendoSales'));
    }

    /**
     * Get total sales per month for all customers.
     *
     * @return array
     */
    public function getCustomerMonthlySales()
    {
        // Sum sales grouped by month
        $monthlySales = CustomerTransaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month'); // key = month, value = total sales

        // Fill missing months with 0
        $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $sales[] = $monthlySales[$i] ?? 0;
        }

        return $sales;
    }

     public function getVendoMonthlySales()
    {
        // Sum sales grouped by month
        $monthlySales = VendoTransaction::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month'); // key = month, value = total sales

        // Fill missing months with 0
        $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $sales[] = $monthlySales[$i] ?? 0;
        }

        return $sales;
    }

    public function getExpensesMonthlySales()
    {
        // Sum sales grouped by month
        $monthlySales = Expense::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month'); // key = month, value = total sales

        // Fill missing months with 0
        $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $sales[] = $monthlySales[$i] ?? 0;
        }

        return $sales;
    }

    
}
