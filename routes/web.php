<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Listing
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Product Creation
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Product Editing
    Route::get('/products/{productId}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{productId}', [ProductController::class, 'update'])->name('products.update');

    // Product Deletion
    Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

    // PDF Generation
    Route::get('/products/{productId}/pdf', [ProductController::class, 'generatePdf'])->name('products.pdf');

    Route::get('/product-images/{filename}', [ProductImageController::class, 'show'])->name('product.image.show');

});

require __DIR__.'/auth.php';
