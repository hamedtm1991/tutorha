<?php

use App\Http\Controllers\ImageController;
use App\Livewire\Panel\Transactions;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth;
use App\Livewire\Landings\Home;
use App\Livewire\Landings\Course;
use App\Livewire\Landings\Payment;
use App\Livewire\Landings\Landings;
use App\Http\Controllers\PaymentController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/images/get/{name}/{rand}', [ImageController::class, 'getImage'])->name('getImage');
    Route::get('payment', Payment::class)->name('payment');
    Route::get('payment/bank/{value}', [PaymentController::class, 'increase'])->name('bank');
    Route::get('transactions', Transactions::class)->name('transactions');
});

Route::get('login', Auth::class)->name('login');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('course/{product}/{title}', Course::class)->name('course');
Route::get('/images/public/get/{name}/{rand}', [ImageController::class, 'getPublicImage'])->name('getPublicImage');
Route::get('/landings/{title}', Landings::class)->name('landings');
Route::get('/', Home::class)->name('home');
Route::post('/bank/payment/callback', [PaymentController::class, 'callbackFromBank'])->name('callback');
