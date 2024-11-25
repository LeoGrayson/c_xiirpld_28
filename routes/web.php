<?php

use App\Http\Controllers\CheckupController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\EnlistmentController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for Admin (Admin)
Route::middleware(['auth', 'role:1'])->prefix('admin')->name('admin.')->group(function () {
    // Prefix 'admin' ditambahkan pada setiap route admin
    Route::resource('enlistments', EnlistmentController::class)->except(['show']);
    Route::resource('checkups', CheckupController::class)->except(['show']);
    Route::resource('doctors', DoctorsController::class);
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group( function () {
    Route::resource('enlistments', EnlistmentController::class);
    Route::resource('checkups', CheckupController::class);
});

Route::get('reports/checkup/{id}', [CheckupController::class, 'downloadCheckupReport'])->name('reports.checkup');

require __DIR__.'/auth.php';
