<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use App\Models\HostelImage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class LandlordHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = auth()->user()->hostel;
        return Inertia::render('Landlord/HostelManagement', [
            'hostels' => $hostels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Landlord/AddHostel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
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

        return redirect('/landlord/hostel/')->with('flash', 'Hostel created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hostel = Hostel::with('images')->findOrFail($id);
        return Inertia::render('Landlord/HostelDetail', ['hostel' => $hostel]);
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
        return Inertia::render('Landlord/EditHostel', ['hostels' => $hostels]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hostel $hostels)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'number' => 'required|integer',
            'location' => 'required',
            'description' => 'required',

        ]);

        $hostels->update($formFields);


        return redirect('/landlord/hostel/')->with('success', 'Location Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hostel $hostels)
    {
        $hostels->delete();
        return redirect('/landlord/hostel/')->with('flash', 'Hostel deleted successfully');
    }
}
