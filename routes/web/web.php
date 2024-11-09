<?php

use App\Http\Controllers\ImageController;
use App\Livewire\Panel\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth;
use App\Livewire\Landings\Home;
use App\Livewire\Landings\Course;
use App\Livewire\Landings\Payment;
use App\Livewire\Landings\Landings;
use App\Http\Controllers\PaymentController;
use App\Livewire\Panel\Courses;
use App\Livewire\Landings\Blogs;
use App\Livewire\Landings\BlogDetails;
use Illuminate\Support\Facades\Storage;

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
    Route::get('payment/{value?}', Payment::class)->name('payment');
    Route::get('payment/bank/{value}', [PaymentController::class, 'increase'])->name('bank');
    Route::get('transactions', Transactions::class)->name('transactions');
    Route::get('my-courses', Courses::class)->name('my-courses');
});

Route::get('login', Auth::class)->name('login');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('courses/{slug}', Course::class)->name('courses');
Route::get('/images/public/get/{name}/{rand}', [ImageController::class, 'getPublicImage'])->name('getPublicImage');
Route::get('/landings/{title}', Landings::class)->name('landings');
Route::get('/', Home::class)->name('home');
Route::get('/blog', Blogs::class)->name('blog');
Route::get('/blog/{id}', BlogDetails::class)->name('blogDetail');
Route::get('/tutors', \App\Livewire\Landings\Tutors::class)->name('tutors');
Route::get('/tutors/{slug}', \App\Livewire\Landings\TutorDetails::class)->name('tutorDetail');

Route::get('/video/s/{name}/{episode}/{key}', function ($name, $episode, $key) {
    return Storage::disk('liara')->download('videos/hls/' . $name . '/'. $episode . '/' . $key);
})->name('video.key');

Route::get('/video/{playlist}/{episode}/{ip}', function (Request $request, string $playlist, string $episode, string $ip) {
    if (! $request->hasValidSignatureWhileIgnoring(['title']) || $ip !== $request->ip()) {
        abort(401);
    }

    $explode = explode('.', $playlist);
    $name = $explode[0];

    $title = $request->title ?? $name . '.m3u8';
    $path = 'videos/hls/' . $name . '/'. $episode .'/' . $title;


    if (!$request->title || ($request->title && !str_contains($request->title, '.ts'))) {
        $file = Storage::disk('liara')->get($path);
        $file =  str_replace($name, $request->fullUrl() . '&title=' . $name, $file);
        return str_replace('URI="', 'URI="/video/s/'. $name  . '/' . $episode . '/', $file);
    }

    return Storage::disk('liara')->download($path);
})->name('video');

Route::get('/blog/detail/{id}', function (Request $request) {
    return redirect('blog/' . $request->id);
});

Route::get('course/{product}/{title}', function (Request $request) {
    $product = \App\Models\Product::findOrFail($request->product);
    return redirect('courses/' . $product->slug);
});


Route::get('/{tag}', \App\Livewire\Landings\AllCourses::class)->name('all-courses');
