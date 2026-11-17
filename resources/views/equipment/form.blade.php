@extends('layouts.master')
@section('title', 'Equipment List')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Equipment List</h3>
    <a href="{{ route('equipment.create') }}" class="btn btn-success">+ Add Equipment</a>
</div>
<table class="table table-bordered table-striped bg-white">
    <thead class="table-success">
        <tr><th>#</th><th>Name</th><th>Category</th><th>Price</th><th>Status</th><th width="220">Actions</th></tr>
    </thead>
    <tbody>
    @forelse($equipment as $e)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $e->equipment_name }}</td>
            <td>{{ $e->category }}</td>
            <td>₱{{ number_format($e->unit_price, 2) }}</td>
            <td><span class="badge bg-{{ $e->availability_status === 'available' ? 'success' : 'secondary' }}">{{ ucfirst($e->availability_status) }}</span></td>
            <td>
                <a href="{{ route('equipment.show', $e) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('equipment.edit', $e) }}" class="btn btn-warning btn-sm">Edit</a>
                <form method="POST" action="{{ route('equipment.destroy', $e) }}" class="d-inline"
                      onsubmit="return confirm('Delete this equipment?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td><div class="space-y-4">
    <div>
        <x-input-label for="equipment_name" :value="__('Equipment Name')" />
        <x-text-input id="equipment_name" name="equipment_name" type="text" class="block mt-1 w-full"
            :value="old('equipment_name', $equipment->equipment_name ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('equipment_name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category" :value="__('Category')" />
        <select id="category" name="category" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">-- Select category --</option>
            @foreach (\App\Models\Equipment::CATEGORIES as $category)
                <option value="{{ $category }}" @selected(old('category', $equipment->category ?? '') === $category)>
                    {{ $category }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="unit_price" :value="__('Unit Price')" />
        <x-text-input id="unit_price" name="unit_price" type="number" step="0.01" min="0" class="block mt-1 w-full"
            :value="old('unit_price', $equipment->unit_price ?? '')" required />
        <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="3"
            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $equipment->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="availability_status" :value="__('Availability')" />
        <select id="availability_status" name="availability_status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
            @foreach (\App\Models\Equipment::STATUSES as $status)
                <option value="{{ $status }}" @selected(old('availability_status', $equipment->availability_status ?? 'available') === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('availability_status')" class="mt-2" />
    </div>

    <div class="flex items-center gap-3">
        <x-primary-button>{{ $submitLabel ?? __('Save') }}</x-primary-button>
        <a href="{{ route('equipment.index') }}" class="text-sm text-gray-600 underline">Cancel</a>
    </div>
</div>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center">No equipment yet.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection