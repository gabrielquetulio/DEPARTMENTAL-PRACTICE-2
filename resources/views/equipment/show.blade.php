@extends('layouts.master')
@section('title', 'Edit Equipment')
@section('content')
<h3>Edit Equipment</h3>
<form method="POST" action="{{ route('equipment.update', $equipment) }}" class="card card-body">
    @csrf @method('PUT')
    @include('equipment._form')
</form>
@endsection@extends('layouts.master')

@section('title', $equipment->equipment_name)

@section('content')
<h3>{{ $equipment->equipment_name }}</h3>

<div class="card card-body">
    <dl class="row mb-0">
        <dt class="col-sm-3">Category</dt>
        <dd class="col-sm-9">{{ $equipment->category }}</dd>

        <dt class="col-sm-3">Unit Price</dt>
        <dd class="col-sm-9">{{ number_format($equipment->unit_price, 2) }}</dd>

        <dt class="col-sm-3">Availability</dt>
        <dd class="col-sm-9">{{ ucfirst($equipment->availability_status) }}</dd>

        <dt class="col-sm-3">Description</dt>
        <dd class="col-sm-9">{{ $equipment->description }}</dd>
    
        <dt class="col-sm-3">Added By</dt>
        <dd class="col-sm-9">{{ $equipment->user?->name }}</dd>
    </dl>
</div>

<div class="mt-3">
    <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection