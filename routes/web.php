<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\AdminProductController;

// Public User Routes
Route::get('/', [UserController::class, 'userHome'])->name('user.home');

Route::get('tops', [UserController::class, 'tops'])->name('user.tops');
Route::get('bottoms', [UserController::class, 'bottoms'])->name('user.bottoms');
Route::get('bags-n-accessories', [UserController::class, 'bna'])->name('user.bna');
Route::get('footwear', [UserController::class, 'footwear'])->name('user.footwear');

// Login / Signup
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.post');

Route::get('signup', [UserController::class, 'signup'])->name('signup');
Route::post('signup', [UserController::class, 'register'])->name('signup.post');

Route::get('admin-login', [UserController::class, 'adminLogin'])->name('admin.login');

// Product Description
Route::get('/description/{id}', [UserController::class, 'show'])->name('description');

// Protected User Routes
Route::middleware(['auth'])->group(function () {

    // User Account
    Route::get('/account', function () {
        return view('user.account', ['active' => 'account']);
    })->name('account');

    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::get('/myorders', function () {
        return view('user.orders', ['active' => 'orders']);
    });

    Route::get('payment', [UserController::class, 'checkoutnpayment'])->name('checkoutnpayment');
    Route::post('/checkout/save', [UserController::class, 'saveCheckout'])->name('checkout.save');

    // Admin Section
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/orders', [UserController::class, 'adminOrders'])->name('admin.orders');
    Route::get('/admin/customers', [UserController::class, 'adminCustomers'])->name('admin.customers');

    // Admin Products (Group with prefix and name)
    Route::prefix('admin/products')->name('admin.products.')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('index');
        Route::post('/add', [AdminProductController::class, 'add'])->name('add');
        Route::post('/edit/{id}', [AdminProductController::class, 'edit'])->name('edit');
        Route::post('/delete/{id}', [AdminProductController::class, 'delete'])->name('delete.post'); // renamed to avoid conflict
    });
});

Route::delete('/admin/products/{id}', [AdminProductController::class, 'delete'])->name('admin.products.delete');

// Orders
Route::post('/place-order', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/report', [OrderController::class, 'generateOrdersPDF'])->name('generateOrders.report');
Route::post('/admin/orders/bulk-action', [OrderController::class, 'bulkAction'])->name('admin.orders.bulkAction');
Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');

// Customers
Route::get('/customers/report', [CustomerController::class, 'generateCustomerPDF'])->name('generateCustomer.report');
Route::post('/customers/bulk-action', [CustomerController::class, 'bulkAction'])->name('customers.bulkAction');
Route::post('/admin/customers/edit/{id}', [AdminCustomerController::class, 'edit'])->name('admin.customers.edit');
Route::post('/admin/customers/delete/{id}', [AdminCustomerController::class, 'delete'])->name('admin.customers.delete');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/finance/report', [FinanceController::class, 'generateFinancePDF'])->name('generateFinance.report');
