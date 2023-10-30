<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth;
use App\Livewire\Landings\Home;
use App\Livewire\Landings\Course;
use App\Livewire\Landings\Payment;

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

Route::get('login', Auth::class)->name('login');
Route::get('home', Home::class)->name('home');
Route::get('course/{product}/{title}', Course::class)->name('course');
Route::get('/images/public/get/{name}/{rand}', [ImageController::class, 'getPublicImage'])->name('getPublicImage');

Route::middleware(['auth'])->group(function () {
    Route::get('/images/get/{name}/{rand}', [ImageController::class, 'getImage'])->name('getImage');
    Route::get('payment', Payment::class)->name('payment');
});
