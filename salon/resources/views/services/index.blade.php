@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mb-1">Services</h1>
        <p class="text-muted mb-0">Manage the salon and nail service catalog.</p>
    </div>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Add New Service</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>
                            <strong>{{ $service->name }}</strong>
                        </td>
                        <td>₱{{ number_format($service->price, 2) }}</td>
                        <td>{{ $service->duration }}</td>
                        <td>{{ $service->description ?: 'No description provided' }}</td>
                        <td class="text-end">
                            <a href="{{ route('services.show', $service) }}" class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('services.destroy', $service) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
