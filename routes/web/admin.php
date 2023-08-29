<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Acl;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Courses;

Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('users', Users::class)->name('users');
Route::get('acl', Acl::class)->name('acl');
Route::get('courses', Courses::class)->name('courses');
