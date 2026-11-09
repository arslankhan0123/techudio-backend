<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\Frontend\InquiryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/request-a-quote', 'frontend.request-a-quote')->name('quote');
Route::view('/contact-us', 'frontend.contact-us')->name('contact');

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/request-a-quote', [InquiryController::class, 'storeQuote'])->name('quote.store');
    Route::post('/contact-us', [InquiryController::class, 'storeContact'])->name('contact.store');
});

Route::middleware(['auth', 'master.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('quotes', [QuoteRequestController::class, 'index'])->name('quotes.index');
    Route::get('quotes/{quote}', [QuoteRequestController::class, 'show'])->name('quotes.show');
    Route::get('quotes/{quote}/files/{index}', [QuoteRequestController::class, 'download'])->name('quotes.download');
    Route::delete('quotes/{quote}', [QuoteRequestController::class, 'destroy'])->name('quotes.destroy');

    Route::get('contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactMessageController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');
});

Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
