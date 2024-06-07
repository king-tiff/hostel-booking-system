<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Landlord/LandlordDashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // ADMIN
    Route::middleware('role:admin')->group(function () {
    });

    //LANDLORD
    Route::middleware('role:admin|landlord')->group(function () {
        
        //Hostels
        Route::get('/landlord/hostel/', [HostelController::class, 'index'])->name('landlord.hostel');
        Route::get('/landlord/add-hostel', [HostelController::class, 'create'])->name('landlord.hostel.create');
        Route::post('/landlord/add-hostel', [HostelController::class, 'store'])->name('landlord.hostel.store');
        Route::get('/landlord/{hostels}/edit', [HostelController::class, 'edit'])->name('landlord.hostel.edit');
        Route::put('/landlord/{hostels}/edit', [HostelController::class, 'update'])->name('landlord.hostel.update');
        Route::delete('/landlord/{hostels}/delete', [HostelController::class, 'destroy'])->name('landlord.hostel.destroy');


        //Rooms
        Route::get('/landlord/rooms/', [RoomController::class, 'index'])->name('landlord.rooms.index');
        Route::get('/landlord/rooms/add-room', [RoomController::class, 'create'])->name('landlord.room.create');
        Route::post('/landlord/rooms/add-room', [RoomController::class, 'store'])->name('landlord.room.store');
        Route::get('/landlord/rooms/{room}/edit', [RoomController::class, 'edit'])->name('landlord.room.edit');
        Route::put('/landlord/rooms/{room}/edit', [RoomController::class, 'update'])->name('landlord.room.update');
        Route::delete('/landlord/rooms/{room}/delete', [RoomController::class, 'destroy'])->name('landlord.room.destroy');

        //Bookings
        Route::get('/landlord/bookings/', [BookingController::class, 'index'])->name('landlord.bookings.index');
        Route::get('/landlord/bookings/add-booking', [BookingController::class, 'create'])->name('landlord.bookings.create');
        Route::post('/landlord/bookings/add-booking', [BookingController::class, 'store'])->name('landlord.bookings.store');
        Route::get('/landlord/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('landlord.bookings.edit');
        Route::put('/landlord/bookings/{booking}/edit', [BookingController::class, 'update'])->name('landlord.bookings.update');
        Route::delete('/landlord/bookings/{booking}/delete', [BookingController::class, 'destroy'])->name('landlord.bookings.destroy');
    });

    // USER
    Route::middleware('role:user')->group(function () {
    });
});


require __DIR__ . '/auth.php';
