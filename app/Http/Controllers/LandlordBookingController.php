<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Inertia\Inertia;

class LandlordBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch bookings for the authenticated landlord's hostels
        $bookings = Booking::with(['user', 'room.hostel'])
            ->whereHas('room.hostel', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();

        return Inertia::render('Landlord/BookingManagement', [
            'bookings' => $bookings,
        ]);
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
    public function edit(Booking $booking)
    {
        // Ensure the booking belongs to one of the landlord's hostels
        // $this->authorize('view', $booking);

        return Inertia::render('Landlord/EditBooking', [
            'booking' => $booking->load('user', 'room.hostel')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
       public function update(Request $request, Booking $booking)
    {
        // Ensure the booking belongs to one of the landlord's hostels
        // $this->authorize('update', $booking);

        $data = $request->validate([
            'status' => 'required|in:Approved,Rejected'
        ]);

        $booking->update($data);

        return redirect()->route('landlord.bookings.index')->with('flash', 'Booking updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect('/landlord/bookings/')->with('flash', 'Booking deleted successfully');
    }
}
