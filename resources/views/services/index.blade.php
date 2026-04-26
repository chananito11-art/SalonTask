@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Service Management</h2>
        </div>

        <a class="btn" href="{{ route('services.create') }}">Add Service</a>
    </section>

    <section class="panel">
        @if ($services->isEmpty())
            <div class="empty">No services available yet.</div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>PHP {{ number_format($service->price, 2) }}</td>
                                <td>{{ $service->duration }}</td>
                                <td>{{ $service->description ?: 'No description provided.' }}</td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-secondary" href="{{ route('services.edit', $service) }}">Edit</a>

                                        <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
