@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Service Details</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">{{ $service->name }}</dd>

                    <dt class="col-sm-4">Price</dt>
                    <dd class="col-sm-8">₱{{ number_format($service->price, 2) }}</dd>

                    <dt class="col-sm-4">Duration</dt>
                    <dd class="col-sm-8">{{ $service->duration }}</dd>

                    <dt class="col-sm-4">Description</dt>
                    <dd class="col-sm-8">{{ $service->description ?: 'No description provided' }}</dd>
                </dl>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
