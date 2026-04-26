<div class="form-grid">
    <div>
        <label for="name">Service Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $service->name) }}" required>
    </div>

    <div>
        <label for="price">Price</label>
        <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price', $service->price) }}" required>
    </div>

    <div>
        <label for="duration">Duration</label>
        <input id="duration" type="text" name="duration" value="{{ old('duration', $service->duration) }}" placeholder="e.g. 45 minutes" required>
    </div>

    <div class="full">
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description', $service->description) }}</textarea>
    </div>
</div>

<div class="actions" style="margin-top: 18px;">
    <button class="btn" type="submit">{{ $submitLabel }}</button>
    <a class="btn btn-secondary" href="{{ route('services.index') }}">Cancel</a>
</div>
