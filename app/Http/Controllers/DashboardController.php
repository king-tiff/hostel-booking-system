<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $totalHostels = Hostel::count();
            $totalRooms = Room::count();
            $totalBookings = Booking::count();
            $totalUsers = User::count();

            return Inertia::render('Admin/Dashboard', [
                'totalHostels' => $totalHostels,
                'totalRooms' => $totalRooms,
                'totalBookings' => $totalBookings,
                'totalUsers' => $totalUsers,
            ]);
        } else if (auth()->user()->hasRole('landlord')) {
            // return Inertia::render('Landlord/Dashboard');
            $bookings = Booking::with(['user', 'room.hostel'])
            ->whereHas('room.hostel', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return Inertia::render('Landlord/Dashboard', [
            'bookings' => $bookings,
        ]);
        } else {

            $bookings = Booking::with(['room.hostel'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

            return Inertia::render('User/Dashboard', [
                'bookings' => $bookings,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
