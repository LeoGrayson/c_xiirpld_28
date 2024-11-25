@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Checkup</h1>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.checkups.update', $checkup->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Patient Name -->
            <div class="form-group">
    <label class="font-weight-bold">Patient Name</label>
    <select 
        name="patient_id" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('patient_id') is-invalid @enderror" 
        required>
        <option value="">-- Select Patient --</option>
        @foreach ($enlistments as $enlistment)
            <option 
                value="{{ $enlistment->id }}" 
                {{ old('patient_id', $checkup->patient_id ?? '') == $enlistment->id ? 'selected' : '' }}>
                {{ $enlistment->patient_name }}
            </option>
        @endforeach
    </select>
    @error('patient_id')
        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
    @enderror
</div>



            <!-- Checkup Date -->
            <div class="form-group">
                <label class="font-weight-bold">Checkup Date</label>
                <input type="date" name="checkup_date" value="{{ old('checkup_date', $checkup->checkup_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_date') is-invalid @enderror" required>
                @error('checkup_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Handling -->
            <div class="form-group">
                <label class="font-weight-bold">Handling</label>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="handling" value="inpatient" class="form-radio text-blue-600" {{ old('handling', $checkup->handling) == 'inpatient' ? 'checked' : '' }} required>
                        <span class="ml-2">Inpatient</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="handling" value="outpatient" class="form-radio text-blue-600" {{ old('handling', $checkup->handling) == 'outpatient' ? 'checked' : '' }} required>
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
                        <option value="{{ $doctor->id }}" {{ old('doctor_id', $checkup->doctor_id) == $doctor->id ? 'selected' : '' }}>
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
                <input type="number" name="price" value="{{ old('price', $checkup->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('price') is-invalid @enderror" placeholder="Enter price..." required>
                @error('price')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Checkup Result -->
             <div class="form-group">
                <label class="font-weight-bold">Checkup Result</label>
                <textarea name="checkup_result" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_result') is-invalid @enderror" placeholder="Enter checkup result..." required>{{ old('checkup_result', $checkup->checkup_result) }}</textarea>
                @error('checkup_result')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
             </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <i class="fa-solid fa-save"></i> Save Changes
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