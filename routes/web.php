<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ApartmentPicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorshipController;
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
    return view('welcome');
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    //Route additional images
    Route::delete('/apartment-pics/{apartment_pic}', [ApartmentPicController::class, 'destroy'])->name('apartment-pics.destroy');
    Route::post('/apartment-pics', [ApartmentPicController::class, 'store'])->name('apartment-pics.store');
    //Rotte degli apartments
    Route::resource('apartments', ApartmentController::class);
    Route::patch('apartments/{apartment}/toggle-visibility', [ApartmentController::class, 'toggleVisibility'])->name('apartments.toggle-visibility');
    //Rotte delle sponsorships
    Route::get('sponsorships/{apartment}', [SponsorshipController::class, 'index'])->name('sponsorships.index');
    //Rotte dei messages
    // Route::resource('messages', MessageController::class);
    Route::get('/messages/index/{apartment}', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    // Route payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
