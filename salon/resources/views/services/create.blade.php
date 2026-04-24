@extends('layouts.app')

@section('title', 'Add Service')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Add New Service</div>
            <div class="card-body">
                <form method="POST" action="{{ route('services.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" placeholder="30 mins, 1 hour" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Service</button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
