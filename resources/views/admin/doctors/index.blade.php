@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Doctor List</h1>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary mb-3">Add New Doctor</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Specialty</th>
                <th>Poli</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $doctor->name }}</td>
                    <td class="px-4 py-3">{{ $doctor->specialty }}</td>
                    <td class="px-4 py-3">{{ $doctor->poli }}</td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50"">Edit</a>
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection