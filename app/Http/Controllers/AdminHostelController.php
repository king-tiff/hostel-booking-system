<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
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
        ]);
        $formFields['user_id'] = auth()->user()->id;

        Hostel::create($formFields);

        return redirect()->route('admin.hostels.index')->with('flash', 'Hostel created successfully.');
    }
    /**
     * Display the specified resource.
     */
    // public function show(Hostel $hostel)
    // {
    //     return Inertia::render('Admin/Hostels/Show', [
    //         'hostel' => $hostel
    //     ]);
    // }

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
