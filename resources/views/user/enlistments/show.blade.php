@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Detail Pendaftaran</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
    <p><strong>Lampiran:</strong></p>
        @if ($enlistment->attachment)
            <a href="{{ asset('storage/' . $enlistment->attachment) }}" target="_blank">
                <img src="{{ asset('storage/' . $enlistment->attachment) }}" alt="Attachment" class="w-40 h-40 object-cover">
            </a>
        @else
            <p>No Attachment</p>
        @endif
        <p><strong>Tanggal Pendaftaran:</strong> {{ \Carbon\Carbon::parse($enlistment->enlistment_date)->format('d M Y') }}</p>
        <p><strong>Tanggal Periksa:</strong> {{ $enlistment->checkup_date ? \Carbon\Carbon::parse($enlistment->checkup_date)->format('d M Y') : 'Pending' }}</p>
        <p><strong>Nama Dokter:</strong> {{ $enlistment->doctor->name ?? 'Unknown Doctor' }}</p>
        <p><strong>Nama Pasien:</strong> {{ $enlistment->patient_name ?? 'Unknown Patient' }}</p>
        <p><strong>Keluhan:</strong> {{ $enlistment->complaint }}</p>
        <p><strong>Poli:</strong> {{ $enlistment->poly->name ?? 'No Poly Assigned' }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('user.enlistments.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-gray-500 focus:ring-opacity-50">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu Pendaftaran
        </a>
    </div>
</div>
@endsection