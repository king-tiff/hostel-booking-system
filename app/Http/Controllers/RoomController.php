<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('hostel')
            ->orderBy('created_at', 'desc')
            ->get();
        return Inertia::render('Landlord/RoomManagement', [
            'rooms' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostels = Hostel::where('user_id', auth()->id())->get();
        return Inertia::render('Landlord/AddRoom', [
            'hostels' => $hostels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $formFields = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'type' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string'
        ]);

        // Create the room
        Room::create($formFields);

        // Redirect with success message
        return redirect('/landlord/rooms')->with('flash', 'Room created successfully.');
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
    public function edit(Room $room)
{
    $hostels = Hostel::where('user_id', auth()->id())->get();
    return Inertia::render('Landlord/EditRoom', [
        'room' => $room,
        'hostels' => $hostels
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $formFields = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'type' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);
    
        $room->update($formFields);
    
        return redirect()->route('landlord.rooms.index')->with('flash', 'Room updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/landlord/rooms/')->with('flash', 'Hostel deleted successfully');
    }
}
