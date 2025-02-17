<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\LandlordBookingController;
use App\Http\Controllers\LandlordHostelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandlordRoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminHostelController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BookingController;

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

Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/rooms', [WebsiteController::class, 'filtering'])->name('rooms.filtering');

Route::middleware('auth')->group(function () {
    Route::get('/rooms/{id}', [WebsiteController::class, 'show'])->name('room.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:user')->group(function () {

        Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.user');
        Route::get('/add-bookings', [BookingController::class, 'view'])->name('bookings.view');
        Route::get('/booking/request/{id}', [BookingController::class, 'create'])->name('bookings.request');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::get('/bookings/{id}/download', [BookingController::class, 'download'])->name('bookings.download');
        Route::delete('bookings/{booking}/delete', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });
    // ADMIN
    Route::middleware('role:admin')->group(function () {

        //Hostels
        Route::get('/admin/hostels/', [AdminHostelController::class, 'index'])->name('admin.hostels.index');
        Route::get('/admin/add-hostel', [AdminHostelController::class, 'create'])->name('admin.hostel.create');
        Route::post('/admin/add-hostel', [AdminHostelController::class, 'store'])->name('admin.hostel.store');
        Route::get('/admin/hostel/{id}', [AdminHostelController::class, 'show'])->name('admin.hostel.show');
        Route::post('/admin/hostel/{id}/add-image', [AdminHostelController::class, 'addImage'])->name('admin.hostel.addImage');
        Route::delete('/admin/hostel/image/{id}', [AdminHostelController::class, 'deleteImage'])->name('admin.hostel.deleteImage');
        Route::get('/admin/{hostels}/edit', [AdminHostelController::class, 'edit'])->name('admin.hostel.edit');
        Route::put('/admin/{hostels}/edit', [AdminHostelController::class, 'update'])->name('admin.hostel.update');
        Route::delete('/admin/{hostels}/delete', [AdminHostelController::class, 'destroy'])->name('admin.hostel.destroy');

        //Rooms
        Route::get('/admin/rooms/', [AdminRoomController::class, 'index'])->name('admin.rooms.index');
        Route::get('/admin/rooms/add-room', [AdminRoomController::class, 'create'])->name('admin.room.create');
        Route::post('/admin/rooms/add-room', [AdminRoomController::class, 'store'])->name('admin.room.store');
        Route::get('/admin/rooms/{id}', [AdminRoomController::class, 'show'])->name('admin.room.show');
        Route::post('/admin/rooms/{id}/add-image', [AdminRoomController::class, 'addImage'])->name('admin.room.addImage');
        Route::delete('/admin/rooms/image/{id}', [AdminRoomController::class, 'deleteImage'])->name('admin.room.deleteImage');
        Route::get('/admin/rooms/{room}/edit', [AdminRoomController::class, 'edit'])->name('admin.room.edit');
        Route::put('/admin/rooms/{room}/edit', [AdminRoomController::class, 'update'])->name('admin.room.update');
        Route::delete('/admin/rooms/{room}/delete', [AdminRoomController::class, 'destroy'])->name('admin.room.destroy');

        //Bookings
        Route::get('/admin/bookings/', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        //  Route::get('/admin/bookings/add-booking', [AdminBookingController::class, 'create'])->name('admin.bookings.create');
        //  Route::post('/admin/bookings/add-booking', [AdminBookingController::class, 'store'])->name('admin.bookings.store');
        //  Route::get('/admin/bookings/{booking}/edit', [AdminBookingController::class, 'edit'])->name('admin.bookings.edit');
        //  Route::put('/admin/bookings/{booking}/edit', [AdminBookingController::class, 'update'])->name('admin.bookings.update');
        //  Route::delete('/admin/bookings/{booking}/delete', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

        // User Routes
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/add-user', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/admin/add-user', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::patch('/admin/users/{user}', [AdminUserController::class, 'resetPassword'])->name('admin.users.reset');
    });

    //LANDLORD
    Route::middleware('role:landlord|admin')->group(function () {

        //Hostels
        Route::get('/landlord/hostel/', [LandlordHostelController::class, 'index'])->name('landlord.hostel.index');
        Route::get('/landlord/add-hostel', [LandlordHostelController::class, 'create'])->name('landlord.hostel.create');
        Route::post('/landlord/add-hostel', [LandlordHostelController::class, 'store'])->name('landlord.hostel.store');
        Route::get('/landlord/hostel/{id}', [LandlordHostelController::class, 'show'])->name('landlord.hostel.show');
        Route::post('/landlord/hostel/{id}/add-image', [LandlordHostelController::class, 'addImage'])->name('landlord.hostel.addImage');
        Route::delete('/landlord/hostel/image/{id}', [LandlordHostelController::class, 'deleteImage'])->name('landlord.hostel.deleteImage');
        Route::get('/landlord/{hostels}/edit', [LandlordHostelController::class, 'edit'])->name('landlord.hostel.edit');
        Route::put('/landlord/{hostels}/edit', [LandlordHostelController::class, 'update'])->name('landlord.hostel.update');
        Route::delete('/landlord/{hostels}/delete', [LandlordHostelController::class, 'destroy'])->name('landlord.hostel.destroy');


        //Rooms
        Route::get('/landlord/rooms/', [LandlordRoomController::class, 'index'])->name('landlord.rooms.index');
        Route::get('/landlord/rooms/add-room', [LandlordRoomController::class, 'create'])->name('landlord.room.create');
        Route::post('/landlord/rooms/add-room', [LandlordRoomController::class, 'store'])->name('landlord.room.store');
        Route::get('/landlord/rooms/{id}', [LandlordRoomController::class, 'show'])->name('landlord.room.show');
        Route::post('/landlord/rooms/{id}/add-image', [LandlordRoomController::class, 'addImage'])->name('landlord.room.addImage');
        Route::delete('/landlord/rooms/image/{id}', [LandlordRoomController::class, 'deleteImage'])->name('landlord.room.deleteImage');
        Route::get('/landlord/rooms/{room}/edit', [LandlordRoomController::class, 'edit'])->name('landlord.room.edit');
        Route::put('/landlord/rooms/{room}/edit', [LandlordRoomController::class, 'update'])->name('landlord.room.update');
        Route::delete('/landlord/rooms/{room}/delete', [LandlordRoomController::class, 'destroy'])->name('landlord.room.destroy');

        //Bookings
        Route::get('/landlord/bookings/', [LandlordBookingController::class, 'index'])->name('landlord.bookings.index');
        // Route::get('/landlord/bookings/add-booking', [LandlordBookingController::class, 'create'])->name('landlord.bookings.create');
        // Route::post('/landlord/bookings/add-booking', [LandlordBookingController::class, 'store'])->name('landlord.bookings.store');
        Route::get('/landlord/bookings/{booking}/edit', [LandlordBookingController::class, 'edit'])->name('landlord.bookings.edit');
        Route::put('/landlord/bookings/{booking}/edit', [LandlordBookingController::class, 'update'])->name('landlord.bookings.update');
        Route::delete('/landlord/bookings/{booking}/delete', [LandlordBookingController::class, 'destroy'])->name('landlord.bookings.destroy');
    });

    // USER
    Route::middleware('role:user')->group(function () {
    });
});


require __DIR__ . '/auth.php';
