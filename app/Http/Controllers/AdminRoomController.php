<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('hostel')
        ->orderBy('created_at', 'desc')
        ->get();
    return Inertia::render('Admin/RoomManagement', [
        'rooms' => $rooms,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostels = Hostel::all();
        return Inertia::render('Admin/AddRoom', [
            'hostels' => $hostels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'type' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string'
        ]);

        Room::create($formFields);

        return redirect('/admin/rooms')->with('flash', 'Room created successfully.');
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
        $hostels = Hostel::all();
        return Inertia::render('Admin/EditRoom', [
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

        return redirect()->route('admin.rooms.index')->with('flash', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/admin/rooms/')->with('flash', 'Hostel deleted successfully');
    }
}
