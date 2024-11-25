@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Enlistment</h1>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.enlistments.update', $enlistment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Patient -->
            <div class="form-group">
                <label class="font-weight-bold">Patient Name</label>
                <input type="text" 
                    name="patient_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('patient_name') is-invalid @enderror" 
                    value="{{ old('patient_name', $enlistment->patient_name) }}" 
                    placeholder="Enter Patient Name" 
                    required>
                @error('patient_name')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Enlistment Date -->
            <div class="form-group">
                <label class="font-weight-bold">Enlistment Date</label>
                <input type="date" name="enlistment_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('enlistment_date') is-invalid @enderror" value="{{ old('enlistment_date', $enlistment->enlistment_date) }}" required>
                @error('enlistment_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Checkup Date -->
            <div class="form-group">
                <label class="font-weight-bold">Checkup Date</label>
                <input type="date" name="checkup_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_date') is-invalid @enderror" value="{{ old('checkup_date', $enlistment->checkup_date) }}">
                @error('checkup_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Complaint -->
            <div class="form-group">
                <label class="font-weight-bold">Complaint</label>
                <textarea name="complaint" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('complaint') is-invalid @enderror" required>{{ old('complaint', $enlistment->complaint) }}</textarea>
                @error('complaint')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Doctor -->
            <div class="form-group">
                <label class="font-weight-bold">Doctor</label>
                <select name="doctor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('doctor_id') is-invalid @enderror" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" 
                            {{ old('doctor_id', $enlistment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Poly -->
            <div class="form-group">
                <label class="font-weight-bold">Poly</label>
                <select name="poly_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('poly_id') is-invalid @enderror" required>
                    @foreach($polies as $poly)
                        <option value="{{ $poly->id }}" 
                            {{ old('poly_id', $enlistment->poly_id) == $poly->id ? 'selected' : '' }}>
                            {{ $poly->name }}
                        </option>
                    @endforeach
                </select>
                @error('poly_id')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Attachment -->
            <div class="form-group">
                <label class="font-weight-bold"><i class="fa-solid fa-image"></i> Attachment (Photo)</label>
                @if($enlistment->attachment)
                    <p class="text-sm">Current Attachment: <a href="{{ asset('storage/'.$enlistment->attachment) }}" target="_blank" class="text-blue-600 hover:underline">View</a></p>
                @endif
                <input type="file" name="attachment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('attachment') is-invalid @enderror" accept=".jpg,.jpeg,.png,.pdf">
                @error('attachment')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('admin.enlistments.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Cancel</a>
                <button type="submit" class="ml-2 px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"><i class="fa-solid fa-save"></i> Update</button>
            </div>
        </form>
    </div>
</div>
@endsection 