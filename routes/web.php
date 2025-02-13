<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnvelopeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('dashboard');
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


    Route::post('/envelopes', [EnvelopeController::class, 'store'])->name('envelopes.store');
    Route::delete('/envelopes/{envelope}', [EnvelopeController::class, 'destroy'])->name('envelopes.destroy');
    Route::post('/transactions/{envelope}', [TransactionController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{envelope}/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
