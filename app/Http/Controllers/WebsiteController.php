<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::where('status', true)
            ->whereHas('hostel', function ($query) {
                $query->where('is_verified', true);
            })
            ->with(['images', 'hostel'])
            ->get();
            
        return Inertia::render('Welcome', [
            'rooms' => $rooms,
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
    public function show($id)
{
    $room = Room::with('hostel', 'images')->findOrFail($id);
    $availableSpaces = $room->availableSpaces();
    $nextAvailableDate = $room->nextAvailableDate();

    return Inertia::render('Home/RoomShow', [
        'room' => $room,
        'available_spaces' => $availableSpaces,
        'next_available_date' => $nextAvailableDate,
    ]);
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
