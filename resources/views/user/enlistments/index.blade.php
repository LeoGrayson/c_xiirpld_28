@extends('layouts.app')
<!-- user/enlistments/index.blade.php -->
@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">My Enlistments</h1>
    <!-- Tombol Create -->
    <div class="mb-4">
        <a href="{{ route('user.enlistments.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-green-500 focus:ring-opacity-50">
            <i class="fa-solid fa-square-plus"></i> Tambah Pendaftaran Baru
        </a>
     </div>
    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Tanggal Pendaftaran</th>
                    <th class="px-4 py-3 text-left">Nama Dokter</th>
                    <th class="px-4 py-3 text-left">Tanggal Periksa</th>
                    <th class="px-4 py-3 text-left">Nama Pasien</th>
                    <th class="px-4 py-3 text-left">Keluhan</th>
                    <th class="px-4 py-3 text-left">Poli</th>
                    <th class="px-4 py-3 text-left">Lampiran (Foto)</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($enlistments as $key => $enlistment)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($enlistment->enlistment_date)->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ $enlistment->doctor->name }}</td>
                    <td class="px-4 py-3">
                        {{ $enlistment->checkup_date ? \Carbon\Carbon::parse($enlistment->checkup_date)->format('d M Y') : 'Pending' }}
                    </td>
                    <td class="px-4 py-3">{{ $enlistment->patient_name ?? 'Unknown Patient' }}</td>
                    <td class="px-4 py-3">{{ $enlistment->complaint }}</td>
                    <td class="px-4 py-3">{{ $enlistment->poly->name ?? 'No Poly Assigned' }}</td>
                    <td class="px-4 py-3">
                        @if ($enlistment->attachment)
                            <a href="{{ asset('storage/' . $enlistment->attachment) }}" target="_blank">
                                <img src="{{ asset('storage/' . $enlistment->attachment) }}" alt="Attachment" class="w-20 h-20 object-cover">
                            </a>
                        @else
                            No Attachment
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <div>
                            <a href="{{ route('user.enlistments.show', $enlistment->id) }}"><i class="fa-solid fa-eye"></i> Show</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-3">No enlistments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $enlistments->links() }}
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endpush