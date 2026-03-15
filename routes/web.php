<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/stories', [StoriesController::class, 'index'])->name('stories');
Route::view('/get-involved', 'get-involved')->name('get-involved');
Route::get('/donate', [DonationController::class, 'show'])->name('donate');
Route::post('/donate/redirect', [DonationController::class, 'redirectToJustGiving'])->name('donate.redirect');
Route::get('/api/campaign-data', [DonationController::class, 'getCampaignData'])->name('campaign.data');

// Newsletter subscription
Route::post('/subscribe', [NewsController::class, 'subscribe'])->name('newsletter.subscribe');

// PayPal payment routes
Route::post('/paypal/create-order', [PaypalController::class, 'createOrder'])
    ->name('paypal.create-order');
Route::post('/paypal/capture-order', [PaypalController::class, 'captureOrder'])
    ->name('paypal.capture-order');
Route::get('/paypal/return', [PaypalController::class, 'handleReturn'])->name('paypal.return');
Route::get('/paypal/cancel', [PaypalController::class, 'handleCancel'])->name('paypal.cancel');

// Admin routes for donation management
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::delete('/donations', [AdminDonationController::class, 'bulkDestroy'])->name('donations.bulk-destroy');
    Route::get('/donations/{donation}', [AdminDonationController::class, 'show'])->name('donations.show');
    Route::get('/donations/export/gift-aid', [AdminDonationController::class, 'exportGiftAid'])->name('donations.export-gift-aid');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/users', [ProfileController::class, 'storeUser'])->name('profile.users.store');
});

require __DIR__ . '/auth.php';
