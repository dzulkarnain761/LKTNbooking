<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingPenginapanController;
use App\Http\Controllers\BookingVehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePAgeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserDashboardController;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('LKTNbooking.landing_page');
});

Route::get('/loading', function(){
    return view('loading');
})->name('loading');

Route::get('/booking-penginapan', [BookingPenginapanController::class, 'penginapan']);
Route::get('/booking-jengkaut', [BookingVehicleController::class,'jengkaut']);
Route::get('/payment-page-penginapan', [BookingPenginapanController::class, 'paymentPagePenginapan']);
Route::get('/confirm-booking-vehicle', [BookingVehicleController::class, 'confirmBookingVehicle']);
Route::post('/proceed-booking', [BookingVehicleController::class, 'store']);





Route::get('/dashboard-pending', [DashboardController::class, 'userPending'])->middleware(['auth', 'verified'])->name('dashboard.pending');
Route::get('/dashboard-approved', [DashboardController::class, 'userApproved'])->middleware(['auth', 'verified'])->name('dashboard.approved');
Route::get('/dashboard-completed', [DashboardController::class, 'userCompleted'])->middleware(['auth', 'verified'])->name('dashboard.completed');
Route::get('/dashboard-cancelled', [DashboardController::class, 'userCancelled'])->middleware(['auth', 'verified'])->name('dashboard.cancelled');

Route::get('/dashboard/{booking}/reject', [UserDashboardController::class, 'reject'])->name('booking.reject');


Route::get('/generate-quotation/{booking}', [PDFController::class, 'generateQuotation'])->name('view.quotation');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

// Admin Dashboard Routes
Route::get('admin/dashboard-pending', [DashboardController::class, 'adminPending'])->middleware(['auth', 'admin'])->name('admin.dashboard.pending');
Route::get('admin/dashboard-inprogress', [DashboardController::class, 'adminInProgress'])->middleware(['auth', 'admin'])->name('admin.dashboard.inprogress');
Route::get('admin/dashboard-completed', [DashboardController::class, 'adminCompleted'])->middleware(['auth', 'admin'])->name('admin.dashboard.completed');
Route::get('admin/dashboard-cancelled', [DashboardController::class, 'adminCancelled'])->middleware(['auth', 'admin'])->name('admin.dashboard.cancelled');

Route::get('/admin/dashboard/{booking}/edit', [AdminDashboardController::class, 'edit'])->name('admin.booking.edit');
Route::put('/admin/dashboard/{booking}/update', [AdminDashboardController::class, 'update'])->name('admin.booking.update');
Route::get('/admin/dashboard/{booking}/reject', [AdminDashboardController::class, 'reject'])->name('admin.booking.reject');





