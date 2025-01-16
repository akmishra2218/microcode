@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Leads Details</h1>

    <!-- Display Success/Error Alerts if any -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table with borders and responsive scrolling on small screens -->
    <div class="table-responsive">
        <table id="leads-table" class="table table-bordered table-striped table-hover table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                <tr>
                    <td class="p-3">{{ $lead->name }}</td>
                    <td class="p-3">{{ $lead->email }}</td>
                    <td class="p-3">{{ $lead->phone }}</td>
                    <td class="p-3">{{ $lead->status }}</td>
                    <td class="p-3">
                        @if ($lead->trashed())
                            <form action="{{ route('leads.restore', $lead->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                        @else
                            <a href="{{ route('leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('leads.destroy', $lead) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
