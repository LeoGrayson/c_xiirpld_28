@extends('layouts.app')
<!-- admin/enlistments/index.blade.php -->
@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">List of Enlistments</h1>
    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Doctor Name</th>
                    <th class="px-4 py-3 text-left">Patient Name</th>
                    <th class="px-4 py-3 text-left">Enlistment Date</th>
                    <th class="px-4 py-3 text-left">Checkup Date</th>
                    <th class="px-4 py-3 text-left">Complaint</th>
                    <th class="px-4 py-3 text-left">Poly</th>
                    <th class="px-4 py-3 text-left">Attachment</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($enlistments as $enlistment)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $enlistment->doctor->name }}</td>
                    <td class="px-4 py-3">{{ $enlistment->patient_name }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($enlistment->enlistment_date)->format('d M Y') }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($enlistment->checkup_date)->format('d M Y') }}</td>
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
                        <a href="{{ route('admin.enlistments.edit', $enlistment->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.enlistments.destroy', $enlistment->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center px-4 py-3">No enlistments available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection