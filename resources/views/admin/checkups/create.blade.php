@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create New Checkup</h1>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.checkups.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Checkup Date -->
            <div class="form-group">
                <label class="font-weight-bold">Checkup Date</label>
                <input type="date" name="checkup_date" id="checkup_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_date') is-invalid @enderror" value="{{ old('checkup_date') }}" required>
                @error('checkup_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Patient -->
            <div class="form-group">
                <label class="font-weight-bold">Patient</label>
                <select name="patient_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('enlistmnent_id') is-invalid @enderror" required>
                    <option value="">-- Select Patient --</option>
                    @foreach($enlistments as $enlistment)
                        <option value="{{ $enlistment->id }}" {{ old('enlistment_id') == $enlistment->id ? 'selected' : '' }}>
                            {{ $enlistment->patient_name }}
                        </option>
                    @endforeach
                </select>
                @error('enlistment_id')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Handling -->
            <div class="form-group">
                <label class="font-weight-bold">Handling</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="handling" value="inpatient" class="form-radio text-blue-600" {{ old('handling') == 'inpatient' ? 'checked' : '' }} required>
                            <span class="ml-2">Inpatient</span>
                        </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" name="handling" value="outpatient" class="form-radio text-blue-600" {{ old('handling') == 'outpatient' ? 'checked' : '' }} required>
                    <span class="ml-2">Outpatient</span>
                </label>
                    </div>
                @error('handling')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Doctor -->
            <div class="form-group">
                <label class="font-weight-bold">Doctor</label>
                <select name="doctor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('doctor_id') is-invalid @enderror" required>
                    <option value="">-- Select Doctor --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id || ($enlistment->first()->doctor_id ?? null) == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Price -->
            <div class="form-group">
                <label class="font-weight-bold">Price</label>
                <input type="number" name="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('price') is-invalid @enderror" placeholder="Enter price..." required>
                @error('price')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Checkup Result -->
             <div class="form-group">
                <label class="font-weight-bold">Checkup Result</label>
                <textarea name="checkup_result" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_result') is-invalid @enderror" placeholder="Enter checkup result..." required></textarea>
                @error('checkup_result')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
             </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    <i class="fa-solid fa-upload"></i> Submit
                </button>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
        <strong>There were some problems with your input:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection