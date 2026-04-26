@extends('layouts.app')

@section('content')
    <section class="page-head">
        <div>
            <h2>Add Service</h2>
            <p>Enter the service name, price, duration, and notes for the salon menu.</p>
        </div>
    </section>

    <section class="panel">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            @include('services._form', ['submitLabel' => 'Save Service'])
        </form>
    </section>
@endsection
