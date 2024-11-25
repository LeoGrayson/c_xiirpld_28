@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">List of User Checkups</h1>
    <!-- Tombol Create -->
    <div class="mb-4">
        <a href="{{ route('admin.checkups.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-green-500 focus:ring-opacity-50">
            <i class="fa-solid fa-square-plus"></i> Create New Checkups
        </a>
     </div>
    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Patient Name</th>
                    <th class="px-4 py-3 text-left">Checkup Date</th>
                    <th class="px-4 py-3 text-left">Handling</th>
                    <th class="px-4 py-3 text-left">Doctor</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Checkup Result</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($checkups as $checkup)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td>{{ $checkup->enlistment->patient_name ?? 'N/A' }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($checkup->checkup_date)->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ $checkup->handling }}</td>
                    <td class="px-4 py-3">{{ $checkup->doctor->name }}</td>
                    <td class="px-4 py-3">{{ number_format($checkup->price, 2, ',', '.') }} IDR</td>
                    <td class="px-4 py-3">{{ $checkup->checkup_result ?? 'Not Set' }}</td>
                    <td class="px-4 py-3 text-center">
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="#" method="POST">
                        @csrf
                            <a href="{{ route('admin.checkups.edit', $checkup->id) }}" class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"><i class="fa-solid fa-pen-to-square"></i> EDIT</a>
                        </form>
                        <br>
                        <form action="{{ route('admin.checkups.destroy', $checkup->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"><i class="fa-solid fa-trash"></i> HAPUS</button>
                        </form>
                        <br>
                        <a href="{{ route('reports.checkup', $checkup->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <i class="fa-solid fa-download"></i> Download PDF
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center px-4 py-3">No patient in checkup.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
