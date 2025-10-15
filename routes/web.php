<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAppController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminCustomerAreaController;
use App\Http\Controllers\Admin\AdminCustomerTransactionController;
use App\Http\Controllers\Admin\AdminCustomerPlanController;
use App\Http\Controllers\Admin\AdminVendoController;
use App\Http\Controllers\Admin\AdminVendoTransactionController;
use App\Http\Controllers\Admin\AdminExpensesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminEmployeeCashAdvanceController;
use App\Http\Controllers\Admin\AdminOmadaController;



use App\Http\Controllers\User\UserAppController;
use App\Http\Controllers\User\UserCustomerController;
use App\Http\Controllers\User\UserCustomerAreaController;
use App\Http\Controllers\User\UserCustomerTransactionController;
use App\Http\Controllers\User\UserCustomerPlanController;
use App\Http\Controllers\User\UserVendoController;
use App\Http\Controllers\User\UserVendoTransactionController;
use App\Http\Controllers\User\UserExpensesController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); // assuming your login view is at resources/views/auth/login.blade.php
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');








// Route Middleware for admin role
Route::middleware(['auth','role:admin'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminAppController::class, 'index'])->name('admin.dashboard');


    // Admin Area
    Route::get('/admin/areas', [AdminCustomerAreaController::class, 'index'])->name('admin.areas');
    Route::post('/admin/areas/store', [AdminCustomerAreaController::class, 'store'])->name('admin.customers.areas.store');
    Route::put('/admin/areas/{area}', [AdminCustomerAreaController::class, 'update'])->name('admin.customers.areas.update');
    Route::delete('admin/areas/{area}', [AdminCustomerAreaController::class, 'destroy'])->name('admin.customers.areas.destroy');


    // Admin Plan
    Route::get('/admin/plans', [AdminCustomerPlanController::class, 'index'])->name('admin.customers.plan');
    Route::post('/admin/plans/store', [AdminCustomerPlanController::class, 'store'])->name('admin.customers.plans.store');
    Route::put('/admin/plans/{plan}', [AdminCustomerPlanController::class, 'update'])->name('admin.customers.plans.update');
    Route::delete('admin/plans/{plan}', [AdminCustomerPlanController::class, 'destroy'])->name('admin.customers.plans.destroy');



    // Admin Customer
    Route::get('/admin/customers', [AdminCustomerController::class, 'index'])->name('admin.customers');
    Route::post('/admin/customers', [AdminCustomerController::class, 'store'])->name('admin.customers.store');
    Route::delete('/admin/customers/{customer}', [AdminCustomerController::class, 'destroy'])->name('admin.customers.destroy');
    Route::put('admin/customers/{customer}', [AdminCustomerController::class, 'update'])->name('admin.customers.update');
    Route::get('/admin/customers/{customer}/payment-info', [AdminCustomerController::class, 'paymentInfo']);


    // Admin Vendo
    Route::get('/admin/vendos', [AdminVendoController::class, 'index'])->name('admin.vendos');
    Route::post('/admin/vendos', [AdminVendoController::class, 'store'])->name('admin.vendos.store');
    Route::delete('/admin/vendos/{vendo}', [AdminVendoController::class, 'destroy'])->name('admin.vendos.destroy');
    Route::put('admin/vendos/{vendo}', [AdminVendoController::class, 'update'])->name('admin.vendos.update');


    // Admin Employee
    Route::get('/admin/employees', [AdminEmployeeController::class, 'index'])->name('admin.employees');
    Route::post('/admin/employees/store', [AdminEmployeeController::class, 'store'])->name('admin.employees.store');
    Route::put('/admin/employees/{employee}', [AdminEmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('admin/employees/{employee}', [AdminEmployeeController::class, 'destroy'])->name('admin.employees.destroy');

    // Admin Employee CashAdvance
    Route::get('/admin/employees/cash-advance', [AdminEmployeeCashAdvanceController::class, 'index'])->name('admin.employees.cashadvance');
    Route::post('/admin/employees/cash-advance/store', [AdminEmployeeCashAdvanceController::class, 'store'])->name('admin.employees.cashadvance.store');
    Route::put('/admin/employees/cash-advance/{cashAdvance}', [AdminEmployeeCashAdvanceController::class, 'update'])->name('admin.employees.cashadvance.update');
    Route::delete('admin/employees/cash-advance/{cashAdvance}', [AdminEmployeeCashAdvanceController::class, 'destroy'])->name('admin.employees.cashadvance.destroy');

    // Admin Omada Cloud
    Route::get('/admin/omada/manage', [AdminOmadaController::class, 'index'])->name('admin.omada.manage');



    // Admin Customer Transaction
    Route::get('/admin/customers/new-receipt', [AdminCustomerController::class, 'generateReceipt']);
    Route::post('/admin/customers/store-transaction', [AdminCustomerController::class, 'storeTransaction'])->name('admin.customers.storeTransaction');
    Route::get('/admin/customers-transactions', [AdminCustomerTransactionController::class, 'index'])->name('admin.customers.transaction');

    // Admin Vendo Transaction
    Route::post('/admin/vendos/store-transaction', [AdminVendoController::class, 'storeTransaction'])->name('admin.vendos.storeTransaction');
    Route::get('/admin/vendos-transactions', [AdminVendoTransactionController::class, 'index'])->name('admin.vendos.transaction');
    Route::get('/admin/vendos/{vendo}/harvest-info', [AdminVendoController::class, 'harvestInfo']);



   
    //  Expenses Route
    Route::get('/admin/expenses', [AdminExpensesController::class, 'index'])->name('admin.expenses');
    Route::post('/admin/expenses', [AdminExpensesController::class, 'store'])->name('admin.expenses.store');
    Route::delete('/admin/expenses/{expense}', [AdminExpensesController::class, 'destroy'])->name('admin.expenses.destroy');
    Route::put('admin/expenses/{expense}', [AdminExpensesController::class, 'update'])->name('admin.expenses.update');

});










// Route Middleware for user role
Route::middleware(['auth','role:user'])->group(function () {
    
    Route::get('/user/dashboard', [UserAppController::class, 'index'])->name('user.dashboard');


    // User Area
    Route::get('/user/areas', [UserCustomerAreaController::class, 'index'])->name('user.areas');
    Route::post('/user/areas/store', [UserCustomerAreaController::class, 'store'])->name('user.customers.areas.store');
    Route::put('/user/areas/{area}', [UserCustomerAreaController::class, 'update'])->name('user.customers.areas.update');
    Route::delete('user/areas/{area}', [UserCustomerAreaController::class, 'destroy'])->name('user.customers.areas.destroy');


    // User Plan
    Route::get('/user/plans', [UserCustomerPlanController::class, 'index'])->name('user.customers.plan');
    Route::post('/user/plans/store', [UserCustomerPlanController::class, 'store'])->name('user.customers.plans.store');
    Route::put('/user/plans/{plan}', [UserCustomerPlanController::class, 'update'])->name('user.customers.plans.update');
    Route::delete('user/plans/{plan}', [UserCustomerPlanController::class, 'destroy'])->name('user.customers.plans.destroy');



    // User Customer
    Route::get('/user/customers', [UserCustomerController::class, 'index'])->name('user.customers');
    Route::post('/user/customers', [UserCustomerController::class, 'store'])->name('user.customers.store');
    Route::delete('/user/customers/{customer}', [UserCustomerController::class, 'destroy'])->name('user.customers.destroy');
    Route::put('user/customers/{customer}', [UserCustomerController::class, 'update'])->name('user.customers.update');
    Route::get('/user/customers/{customer}/payment-info', [UserCustomerController::class, 'paymentInfo']);


    // User Vendo
    Route::get('/user/vendos', [UserVendoController::class, 'index'])->name('user.vendos');
    Route::post('/user/vendos', [UserVendoController::class, 'store'])->name('user.vendos.store');
    Route::delete('/user/vendos/{vendo}', [UserVendoController::class, 'destroy'])->name('user.vendos.destroy');
    Route::put('user/vendos/{vendo}', [UserVendoController::class, 'update'])->name('user.vendos.update');
    




    // User Customer Transaction
    Route::get('/user/customers/new-receipt', [UserCustomerController::class, 'generateReceipt']);
    Route::post('/user/customers/store-transaction', [UserCustomerController::class, 'storeTransaction'])->name('user.customers.storeTransaction');
    Route::get('/user/customers-transactions', [UserCustomerTransactionController::class, 'index'])->name('user.customers.transaction');

    // User Vendo Transaction
    Route::post('/user/vendos/store-transaction', [UserVendoController::class, 'storeTransaction'])->name('user.vendos.storeTransaction');
    Route::get('/user/vendos-transactions', [UserVendoTransactionController::class, 'index'])->name('user.vendos.transaction');
    Route::get('/user/vendos/{vendo}/harvest-info', [UserVendoController::class, 'harvestInfo']);



   
    //  Expenses Route
    Route::get('/user/expenses', [UserExpensesController::class, 'index'])->name('user.expenses');
    Route::post('/user/expenses', [UserExpensesController::class, 'store'])->name('user.expenses.store');
    Route::delete('/user/expenses/{expense}', [UserExpensesController::class, 'destroy'])->name('user.expenses.destroy');
    Route::put('user/expenses/{expense}', [UserExpensesController::class, 'update'])->name('user.expenses.update');

});





require __DIR__.'/auth.php';
