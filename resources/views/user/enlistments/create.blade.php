@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Pendaftaran Baru</h1>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('user.enlistments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Enlistment Date -->
            <div class="form-group">
                <label class="font-weight-bold">Tanggal Pendaftaran</label>
                <input type="date" name="enlistment_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('enlistment_date') is-invalid @enderror" required>
                @error('enlistment_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Checkup Date -->
            <div class="form-group">
                <label class="font-weight-bold">Tanggal Periksa</label>
                <input type="date" name="checkup_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('checkup_date') is-invalid @enderror" required>
                @error('checkup_date')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Patient -->
            <div class="form-group">
                <label class="font-weight-bold">Nama Pasien</label>
                <input type="text" 
                    name="patient_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('patient_name') is-invalid @enderror" 
                    value="{{ old('patient_name') }}" 
                    placeholder="Enter Your Name" 
                    required>
                @error('patient_name')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            
            <!-- Doctor -->
            <div class="form-group">
                <label class="font-weight-bold">Nama Dokter</label>
                <select name="doctor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('doctor_id') is-invalid @enderror" required>
                <option value="">-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('patient_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
                </select>
                @error('doctor_id')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Complaint -->
            <div class="form-group">
                <label class="font-weight-bold">Keluhan</label>
                <textarea name="complaint" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('complaint') is-invalid @enderror" placeholder="Describe your complaint..." required>{{ old('complaint') }}</textarea>
                @error('complaint')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Poly -->
            <div class="form-group">
                <label class="font-weight-bold">Poli</label>
                <select name="poly_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('poly_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Poli --</option>
                    @foreach($polies as $poly)
                        <option value="{{ $poly->id }}" {{ old('poly_id') == $poly->id ? 'selected' : '' }}>
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
                <label class="font-weight-bold"><i class="fa-solid fa-image"></i> Lampiran (Foto)</label>
                <input type="file" name="attachment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('attachment') is-invalid @enderror">
                @error('attachment')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"><i class="fa-solid fa-upload"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection