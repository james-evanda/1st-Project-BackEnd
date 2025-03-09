<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\InvoiceController as UserInvoiceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\User\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Redirect based on user role
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Routes (Authenticated Users)
Route::middleware(['auth'])->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard (Product Catalog)
    Route::get('/user/dashboard', [UserProductController::class, 'index'])->name('user.dashboard');

    // User Invoice Management
    Route::get('/invoices', [UserInvoiceController::class, 'index'])->name('user.invoices.index');
    Route::get('/invoices/{invoice}', [UserInvoiceController::class, 'show'])->name('user.invoices.show');

    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('user.invoices.index');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('user.cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');
    Route::get('/order-success', function () {
        return view('user.order-success');
    })->name('user.order.success');
});

// Admin Routes (Restricted to Admin Role)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Admin Product Management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
});

// Authentication Routes
require __DIR__ . '/auth.php';
