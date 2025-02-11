<?php

use App\Http\Controllers\EnvelopeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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
    Route::post('/envelopes/store', [EnvelopeController::class, 'store'])->name('envelopes.store');
    Route::get('/envelopes/list', [EnvelopeController::class, 'list'])->name('envelopes.list');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/list', [TransactionController::class, 'list'])->name('transactions.list');
});

require __DIR__.'/auth.php';
