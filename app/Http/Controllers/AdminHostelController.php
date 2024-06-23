<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use App\Models\HostelImage;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class AdminHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = Hostel::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return Inertia::render('Admin/HostelManagement', [
            'hostels' => $hostels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddHostel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_verified' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        // Add the user ID to the form fields
        $formFields['user_id'] = auth()->user()->id;

        // Create the hostel
        $hostel = Hostel::create($formFields);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');

            // Create the hostel image entry
            HostelImage::create([
                'hostel_id' => $hostel->id,
                'image_path' => $imagePath,
            ]);
        }

        return redirect('/admin/hostel/')->with('flash', 'Hostel created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hostel = Hostel::with('images','user')->findOrFail($id);
        return Inertia::render('Admin/HostelDetail', ['hostel' => $hostel]);
    }

    /**
     * Add Hostel Images.
     */
    public function addImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $hostel = Hostel::findOrFail($id);
        $imagePath = $request->file('image')->store('uploads', 'public');

        HostelImage::create([
            'hostel_id' => $hostel->id,
            'image_path' => $imagePath,
        ]);

        return back()->with('flash', 'Image added successfully.');
    }

    /**
     * Delete Image From Hostel
     */
    public function deleteImage($id)
    {
        $image = HostelImage::findOrFail($id);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('flash', 'Image deleted successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hostel $hostels)
    {
        return Inertia::render('Admin/EditHostel', ['hostels' => $hostels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hostel $hostels)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_verified' => 'required|boolean',
        ]);

        $hostels->update($formFields);

        return redirect()->route('admin.hostels.index')->with('flash', 'Hostel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hostel $hostels)
    {
        $hostels->delete();

        return redirect()->route('admin.hostels.index')->with('flash', 'Hostel deleted successfully.');
    }
}
