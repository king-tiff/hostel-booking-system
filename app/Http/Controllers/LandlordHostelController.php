<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $formFields['user_id'] = auth()->user()->id;

        Hostel::create($formFields);

        return redirect('/landlord/hostel/')->with('flash', 'Hostel created successfully.');
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
