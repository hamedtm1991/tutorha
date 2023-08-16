<?php

use App\Livewire\Admin\Acl\Acl;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('users', Users::class)->name('users');
Route::get('acl', Acl::class)->name('acl');
