@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Enlistment Details</h2>

        <!-- Menampilkan detail pendaftaran pasien -->
        <div class="enlistment-details">
            <p><strong>ID Pendaftaran:</strong> {{ $enlistment->id }}</p>
            <p><strong>ID Pasien:</strong> {{ $enlistment->patient_id }}</p>
            <p><strong>Tanggal Daftar:</strong> {{ $enlistment->tgl_daftar }}</p>
            <p><strong>Keluhan:</strong> {{ $enlistment->keluhan }}</p>
            <p><strong>Poli:</strong> {{ ucfirst($enlistment->poly) }}</p>
            <p><strong>Tanggal Pemeriksaan:</strong> {{ $enlistment->tgl_periksa }}</p>
        </div>

        <!-- Tombol untuk cetak PDF (untuk admin) -->
        @if(auth()->user()->type == 1) <!-- Admin -->
            <div class="mt-3">
                <a href="{{ route('enlistment.report', $enlistment->id) }}" class="btn btn-primary" target="_blank">
                    Cetak Laporan PDF
                </a>
            </div>
        @endif
    </div>
@endsection