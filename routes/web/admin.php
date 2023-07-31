<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;

Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('users', Users::class)->name('users');
