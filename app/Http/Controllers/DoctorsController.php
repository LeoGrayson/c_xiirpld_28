<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::paginate(10);
        return view('doctors.index', ['doctors' => $doctors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'specialist' => 'required|string|max:100',
            'poly' => 'required|string|max:100'
        ]);
    
        // Menyimpan data dokter
        Doctor::create([
            'name' => $request->name,
            'specialist' => $request->specialist,
            'poly' => $request->poly,
        ]);
    
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', ['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialist' => 'required|string|max:100',
            'poly' => 'required|string|max:100'
        ]);

        $doctor = Doctor::findOrFail($id);

        $doctor->save();
        return redirect()->route('doctors.index')->with('success', 'Doctor data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor data deleted successfully.');
    }
}
