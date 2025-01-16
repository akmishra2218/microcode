@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align:center;">Leads Details</h1>
    <table id="leads-table" class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
 @foreach ($leads as $lead)
            <tr>
                <td>{{ $lead->name }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->phone }}</td>
                <td>{{ $lead->status }}</td>
                <td>
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




<!-- <script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#leads-table').DataTable({
            "processing": true, // Show processing indicator
            "serverSide": false, // Assuming you're not using server-side processing
            "responsive": true, // Make table responsive on mobile screens
        });
    });
</script> -->


@endsection