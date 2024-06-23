<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Models\RoomImage;

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
        // Validate the request data including the image file
        $formFields = $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Create the room with the form fields
            $room = Room::create($formFields);

            // Create the room image entry
            RoomImage::create([
                'room_id' => $room->id,
                'image_path' => $imagePath,
            ]);
        } else {
            // Create the room without an image
            Room::create($formFields);
        }

        return redirect('/admin/rooms')->with('flash', 'Room created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::with('images','hostel')->findOrFail($id);
        return Inertia::render('Admin/RoomDetail', ['room' => $room]);
    }

    /**
     * Add Room Images.
     */
    public function addImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $room = Room::findOrFail($id);
        $imagePath = $request->file('image')->store('uploads', 'public');

        RoomImage::create([
            'room_id' => $room->id,
            'image_path' => $imagePath,
        ]);

        return back()->with('flash', 'Image added successfully.');
    }

    /**
     * Delete Image From Room
     */
    public function deleteImage($id)
    {
        $image = RoomImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('flash', 'Image deleted successfully.');
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
