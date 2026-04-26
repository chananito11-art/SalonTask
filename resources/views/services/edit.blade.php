@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Edit Service</h2>
            <p>Update the service details shown to staff when they create bookings.</p>
        </div>
    </section>

    <section class="panel">
        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            @include('services._form', ['submitLabel' => 'Update Service'])
        </form>
    </section>
@endsection
