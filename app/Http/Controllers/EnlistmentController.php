<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Enlistment;
use App\Models\Poly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EnlistmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
{
    $headers = $request->headers->all();
    $search = $request->input('search', '');

    if (Auth::user()->type == 1) {
        // Admin view
        $enlistments = Enlistment::with('poly')
            ->when($search, function ($query) use ($search) {
                return $query->where('patient_name', 'like', "%$search%");
            })
            ->paginate(10);

        return view('admin.enlistments.index', [
            'enlistments' => $enlistments,
            'headers' => $headers,
            'search' => $search,
        ]);
    } else {
        // User view (only their enlistments)
        $enlistments = Enlistment::where('user_id', Auth::user()->id) // Filter berdasarkan ID pengguna
            ->when($search, function ($query) use ($search) {
                return $query->where('patient_name', 'like', "%$search%");
            })
            ->with('poly')
            ->latest('enlistment_date')
            ->paginate(10);

        return view('user.enlistments.index', [
            'enlistments' => $enlistments,
            'search' => $search,
        ]);
    }
}
    
    public function downloadEnlistmentReport($id)
    {
        if (Auth::user()->type != 2) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        $enlistment = Enlistment::findOrFail($id);

        $pdf = PDF::loadView('reports.enlistment', compact('enlistment'));

        return $pdf->download('enlistment_report.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $polies = Poly::all();
        $doctors = DB::table('doctors')->select('id', 'name')->get();
        return view('user.enlistments.create', ['polies' => $polies, 'doctors' => $doctors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'patient_name' => 'required|string|max:255',
                'poly_id' => 'required|exists:polies,id',
                'enlistment_date' => 'required|date',
                'complaint' => 'required|string|max:1000',
                'attachment' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048',
                'checkup_date' => 'required|date',
            ]);

            // Handle file upload for attachment
            $filePath = $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null;

            // Store the enlistment data
            Enlistment::create([
                'doctor_id' => $request->doctor_id,
                'poly_id' => $request->poly_id,
                'patient_name' => $request->patient_name,
                'enlistment_date' => $request->enlistment_date,
                'complaint' => $request->complaint,
                'attachment' => $filePath,
                'checkup_date' => $request->checkup_date,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->route('user.enlistments.index')->with('success', 'Enlistment created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing enlistment: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $enlistment = Enlistment::with('poly', 'doctor')->findOrFail($id);

        return view('user.enlistments.show', ['enlistment' => $enlistment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enlistment = Enlistment::findOrFail($id);
        $polies = Poly::all();
        $doctors = Doctor::all();

        return view('admin.enlistments.edit', [
            'enlistment' => $enlistment,
            'polies' => $polies,
            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_name' => 'required|string|max:255',
            'poly_id' => 'required|exists:polies,id',
            'enlistment_date' => 'required|date',
            'complaint' => 'required|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'checkup_date' => 'required|date',
        ]);

        $enlistment = Enlistment::findOrFail($id);

        // Handle file upload for attachment
        if ($request->hasFile('attachment')) {
            if ($enlistment->attachment) {
                Storage::disk('public')->delete($enlistment->attachment);
            }

            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
            $enlistment->attachment = $attachmentPath;
        }

        // Update enlistment data including user-provided checkup_date
        $enlistment->update([
            'doctor_id' => $request->doctor_id,
            'patient_name' => $request->patient_name,
            'poly_id' => $request->poly_id,
            'enlistment_date' => $request->enlistment_date,
            'complaint' => $request->complaint,
            'checkup_date' => $request->checkup_date, // Update with user-provided checkup_date
        ]);

        if (isset($attachmentPath)) {
            $enlistment->attachment = $attachmentPath;
            $enlistment->save();
        }

        return redirect()->route('admin.enlistments.index')->with('success', 'Enlistment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $enlistment = Enlistment::findOrFail($id);
        $enlistment->delete();

        return redirect()->route('admin.enlistments.index')->with('success', 'Enlistment deleted successfully.');
    }
}