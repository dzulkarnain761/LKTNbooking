<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BookingPenginapanController;
use App\Http\Controllers\BookingVehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserDashboardController;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ICPasswordResetController;
use App\Http\Controllers\PaymentPageController;
use Illuminate\Support\Carbon;

use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {

    return view('LKTNbooking.landing_page');
});

Route::get('/loading', function () {
    return view('loading');
})->name('loading');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('password/reset-ic', [ICPasswordResetController::class, 'showResetForm'])->name('password.request_ic');
Route::post('password/reset-ic', [ICPasswordResetController::class, 'reset'])->name('password.update_ic');



Route::get('/vehicle-booking-calendar', [EventController::class, 'vehicleCalendar'])->name('vehicle.booking.calendar');

Route::get('/booking-penginapan', [BookingPenginapanController::class, 'penginapan']);
Route::get('/booking-jengkaut', [BookingVehicleController::class, 'jengkaut']);

Route::get('/confirm-booking-penginapan', [BookingPenginapanController::class, 'confirmBookingPenginapan'])->name('confirm.booking.penginapan');
Route::get('/confirm-booking-vehicle', [BookingVehicleController::class, 'confirmBookingVehicle'])->name('confirm.booking.vehicle');

Route::post('/create-booking-booking', [BookingVehicleController::class, 'store'])->name('create.booking.vehicle');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard-pending', [DashboardController::class, 'userPending'])->name('dashboard.pending');
    Route::get('/dashboard-approved', [DashboardController::class, 'userApproved'])->name('dashboard.approved');
    Route::get('/dashboard-inprogress', [DashboardController::class, 'userInProgress'])->name('dashboard.inprogress');
    Route::get('/dashboard-completed', [DashboardController::class, 'userCompleted'])->name('dashboard.completed');
    Route::get('/dashboard-cancelled', [DashboardController::class, 'userCancelled'])->name('dashboard.cancelled');

    Route::post('/dashboard/{booking}/reject', [UserDashboardController::class, 'reject'])->name('booking.reject');
    Route::GET('/payment-page/{booking}', [PaymentPageController::class, 'payment'])->name('payment.page');
});

Route::get('/generate-quotation/{booking}', [PDFController::class, 'generateQuotation'])->name('view.quotation');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/send-test-email', function () {
    Mail::to('dzulkarnain761@gmail.com')->send(new TestEmail());
    return 'Test email sent!';
});



require __DIR__ . '/auth.php';

// Admin Dashboard Routes

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard-pending', [DashboardController::class, 'adminPending'])->name('admin.dashboard.pending');
    Route::get('admin/dashboard-approved', [DashboardController::class, 'adminApproved'])->name('admin.dashboard.approved');
    Route::get('admin/dashboard-inprogress', [DashboardController::class, 'adminInProgress'])->name('admin.dashboard.inprogress');
    Route::get('admin/dashboard-completed', [DashboardController::class, 'adminCompleted'])->name('admin.dashboard.completed');
    Route::get('admin/dashboard-cancelled', [DashboardController::class, 'adminCancelled'])->name('admin.dashboard.cancelled');

    Route::get('/admin/dashboard/{booking}/edit', [AdminDashboardController::class, 'edit'])->name('admin.booking.edit');
    Route::post('/admin/dashboard/{booking}/update', [AdminDashboardController::class, 'update'])->name('admin.booking.update');
    Route::post('/admin/dashboard/{booking}/reject', [AdminDashboardController::class, 'reject'])->name('admin.booking.reject');
});
