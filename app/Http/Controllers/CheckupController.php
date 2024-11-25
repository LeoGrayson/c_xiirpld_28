<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Doctor;
use App\Models\Enlistment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function downloadCheckupReport($id)
    {
        if (Auth::user()->type != 1) {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        $checkup = Checkup::findOrFail($id);

        $pdf = PDF::loadView('reports.checkup', compact('checkup'));

        return $pdf->download('checkup_report.pdf');
    }
    public function index()
    {
        if (auth()->user()->type == 1) {
            $checkups = Checkup::with('enlistment')->get();

            return view('admin.checkups.index', [
                'checkups' => $checkups
            ]);
        } else {
            $checkups = Checkup::where('enlistment', function($query) {
                $query->where('patient_id', auth()->user()->id);
            })->get();

            return view('user.checkups.index', [
                'checkups' => $checkups
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->type != 1) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create checkup.');
        }
        $doctors = Doctor::all();
        $enlistments = Enlistment::with('doctor')->get();

        return view('admin.checkups.create', [
            'doctors' => $doctors,
            'enlistments' => $enlistments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (auth()->user()->type != 1) {
                return redirect()->route('dashboard')->with('error', 'You do not have permission to create checkup.');
            }

            $request->validate([
                'checkup_date' => 'required|date',
                'patient_id' => 'required|exists:enlistments,id',
                'doctor_id' => 'required|exists:doctors,id',
                'handling' => ['required', Rule::in(['inpatient', 'outpatient'])],
                'price' => 'required|numeric|min:0',
                'checkup_result' => 'required|string|max:1000',
            ]);
    
            Checkup::create([
                'checkup_date' => $request->checkup_date,
                'patient_id' => $request->patient_id,
                'doctor_id' => $request->doctor_id,
                'handling' => $request->handling,
                'price' => $request->price,
                'checkup_result' => $request->checkup_result,
            ]);
    
            return redirect()->route('admin.checkups.index')->with('success', 'Checkup created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing checkups: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Checkup $checkup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (auth()->user()->type != 1) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to edit checkup.');
        }

        $checkup = Checkup::with('enlistment')->findOrFail($id);
        $enlistments = Enlistment::all();
        $doctors = Doctor::all();

        return view('admin.checkups.edit', [
            'checkup' => $checkup,
            'enlistments' => $enlistments,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Update Checkup Data:', $request->all());
        if (auth()->user()->type != 1) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to update checkup.');
        }

        $request->validate([
            'checkup_date' => 'required|date',
            'patient_id' => 'required|exists:enlistments,id',
            'doctor_id' => 'required|exists:doctors,id',
            'handling' => 'required', Rule::in(['inpatient', 'outpatient']),
            'price' => 'required|numeric|min:0',
            'checkup_result' => 'required|string|max:1000',
        ]);

        $checkup = Checkup::findOrFail($id);

        $checkup->update([
            'checkup_date' => $request->checkup_date,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'handling' => $request->handling,
            'price' => $request->price,
            'checkup_result' => $request->checkup_result,
        ]);

    return redirect()->route('admin.checkups.index')->with('success', 'Checkup updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->type != 1) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to delete checkup.');
        }

        $checkup = Checkup::findOrFail($id);
        $checkup->delete();

        return redirect()->route('admin.checkups.index')->with('success', 'Checkup deleted successfully.');
    }
}
