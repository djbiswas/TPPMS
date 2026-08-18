<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use App\Http\Controllers\Tenant\PaymentController;
use App\Http\Controllers\Tenant\RequestController as TenantRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/privacy', 'public.privacy')->name('privacy');
Route::view('/terms', 'public.terms')->name('terms');

Route::get('/activate/{token}', [ActivationController::class, 'show'])->name('activation.show');
Route::post('/activate/{token}', [ActivationController::class, 'store'])->name('activation.store');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user?->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('tenant.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
    Route::get('/', TenantDashboardController::class)->name('dashboard');
    Route::get('/payments', PaymentController::class)->name('payments');
    Route::get('/documents', fn () => view('tenant.coming-soon', [
        'title' => 'Lease Documents',
        'copy' => 'Your lease and addenda will appear here once property management uploads them.',
    ]))->name('documents');
    Route::get('/history', fn () => view('tenant.coming-soon', [
        'title' => 'Payment History',
        'copy' => 'Verified payments and downloadable receipts will be listed here.',
    ]))->name('history');
    Route::get('/messages', fn () => view('tenant.coming-soon', [
        'title' => 'Messages',
        'copy' => 'Secure messages from property management will show here. For now, use Contact Us.',
    ]))->name('messages');
    Route::get('/requests', [TenantRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{tenantRequest}', [TenantRequestController::class, 'show'])->name('requests.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{tenantRequest}', [AdminRequestController::class, 'show'])->name('requests.show');
    Route::patch('/requests/{tenantRequest}', [AdminRequestController::class, 'update'])->name('requests.update');
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
    Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
    Route::patch('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

Route::get('/attachments/{attachment}', [ContactController::class, 'download'])
    ->middleware('auth')
    ->name('attachments.download');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/license', [LicenseController::class, 'edit'])->name('license.edit');
    Route::post('/license', [LicenseController::class, 'update'])->name('license.update');
});

require __DIR__.'/auth.php';
