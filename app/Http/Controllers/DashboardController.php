<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $hostels = Hostel::where('user_id', auth()->id())->with('rooms.bookings')->get();

        // return Inertia::render('Landlord/LandlordDashboard', [
        //     'hostels' => $hostels
        // ]);
        if (auth()->user()->hasRole('admin')) {
            return Inertia::render('Admin/Dashboard');
        } else if (auth()->user()->hasRole('landlord')) {
            return Inertia::render('Landlord/Dashboard');
        } else {
            return Inertia::render('User/Dashboard');
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
