<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the authenticated user's bookings with the related room and hostel data
        $bookings = Booking::with(['room.hostel'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass the bookings data to the Inertia view
        return Inertia::render('User/Dashboard', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Display all Available resources.
     */
    public function view()
    {
        $rooms = Room::where('status', true)
            ->whereHas('hostel', function ($query) {
                $query->where('is_verified', true);
            })
            ->with(['images', 'hostel'])
            ->get();

        return Inertia::render('User/ViewRooms', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $room = Room::with('hostel')->findOrFail($id);
        return Inertia::render('User/RequestBooking', [
            'room' => $room,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $formFields['user_id'] = Auth::id();

        Booking::create($formFields);

        return redirect()->route('bookings.user')->with('success', 'Booking requested successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['room.hostel', 'user'])->findOrFail($id);

        $availableSpaces = $booking->room->availableSpaces();
        $nextAvailableDate = $booking->room->nextAvailableDate();

        return Inertia::render('User/ShowBooking', [
            'booking' => $booking,
            'available_spaces' => $availableSpaces,
            'next_available_date' => $nextAvailableDate,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $booking = Booking::with('room.hostel')->findOrFail($id);

        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('bookings.user')->with('error', 'Unauthorized access.');
        }

        return Inertia::render('User/EditBooking', [
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            return redirect()->route('bookings.user')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $booking->update($request->only(['check_in_date', 'check_out_date']));

        return redirect()->route('bookings.user')->with('success', 'Booking updated successfully.');
    }

    public function download($id)
    {
        $booking = Booking::with('room.hostel')->findOrFail($id);
        $pdf = Pdf::loadView('booking.report', compact('booking'));
        return $pdf->download('booking_report.pdf');
        // return view('booking.report', compact('booking'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect('/my-bookings')->with('flash', 'Booking Deleted Successful');
    }
}
