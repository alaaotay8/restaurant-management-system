<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Route for the user website
Route::get('/', [UserController::class, 'showHome'])->name('home');
Route::get('/home', [UserController::class, 'showHome'])->name('home');
Route::get('/about', [UserController::class, 'showAbout'])->name('about');
Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu');
Route::get('/category/{name}', [MenuController::class, 'showCategory'])->name('category.view');
Route::get('/product/{name}', [MenuController::class, 'quickView'])->name('product.quick_view');
Route::get('/contact', [ContactController::class, 'showContact'])->name('contactUs');
Route::post('/contact-submit', [ContactController::class, 'submitContact'])->name('contact.submit');
Route::get('/search', [UserController::class, 'showSearch'])->name('search');
Route::post('/search', [UserController::class, 'submitSearch'])->name('search.submit');
Route::post('/search-ajax', [UserController::class, 'ajaxSearch'])->name('search.ajax');

// cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::post('/orders/create-from-cart', [OrdersController::class, 'createFromCart'])->name('orders.createFromCart');

// admin routes
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Admin routes (creation admin avec register on auth)
        Route::get('/accounts', [AdminController::class, 'adminAccounts'])->name('admin.admin_accounts');
        Route::delete('/account/{id}/delete', [AdminController::class, 'deleteAdmin'])->name('profile.delete');
        Route::get('/profile/edit', [AdminController::class, 'edit'])->name('profile.edit');
        Route::match(['put', 'post'], '/profile/edit', [AdminController::class, 'update'])->name('profile.update');

        // category routes
        Route::get('/categories', [CategoryController::class, 'categories'])->name('admin.categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class,'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::match(['put', 'post'], '/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // product routes
        Route::get('/products', [ProductsController::class, 'products'])->name('admin.products');
        Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/products/{name}/edit', [ProductsController::class, 'edit'])->name('products.edit');
        Route::match(['put', 'post'], '/products/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::delete('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

        // order routes
        Route::get('/orders/pending', [OrdersController::class, 'pendingOrders'])->name('orders.pending');
        Route::get('/orders/completed', [OrdersController::class, 'completedOrders'])->name('orders.completed');
        Route::get('/orders', [OrdersController::class, 'allOrders'])->name('admin.orders');
        Route::get('/orders/create', [OrdersController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
        Route::post('/orders/updatePaymentStatus', [OrdersController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
        Route::get('/orders/{order}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrdersController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');

        // table routes
        Route::get('/tables', [TableController::class, 'tables'])->name('admin.tables');
        Route::get('/tables/create', [TableController::class, 'create'])->name('tables.create');
        Route::post('/tables', [TableController::class, 'store'])->name('tables.store');
        Route::post('/tables/updateReservedStatus', [TableController::class, 'updateReservedStatus'])->name('tables.updateReservedStatus');
        Route::get('/tables/{table}/edit', [TableController::class, 'edit'])->name('tables.edit');
        Route::match(['put', 'post'], '/tables/{table}', [TableController::class, 'update'])->name('tables.update');
        Route::delete('/tables/{table}', [TableController::class, 'destroy'])->name('tables.destroy');

        // messages routes
        Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');


    });
});


require __DIR__.'/auth.php';


