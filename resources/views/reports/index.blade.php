@extends('layouts.master')
@section('title', 'Reports')
@section('content')
<h3>Equipment Reports</h3>

<form method="GET" action="{{ route('reports.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="report" class="form-select">
            @foreach($titles as $key => $label)
                <option value="{{ $key }}" @selected(request('report', 'price') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach(\App\Models\Equipment::CATEGORIES as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">All Statuses</option>
            @foreach(\App\Models\Equipment::STATUSES as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-success">Filter</button>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<div class="mb-3">
    {{-- Export links carry the same query string so exports match the filters --}}
    <a href="{{ route('reports.pdf', request()->query()) }}" class="btn btn-danger btn-sm">Export PDF</a>
    <a href="{{ route('reports.excel', request()->query()) }}" class="btn btn-primary btn-sm">Export Excel</a>
</div>

<h5>{{ $title }}</h5>
<table class="table table-bordered bg-white">
    <thead class="table-success">
        <tr><th>Name</th><th>Category</th><th>Unit Price</th><th>Status</th></tr>
    </thead>
    <tbody>
    @forelse($rows as $r)
        <tr>
            <td>{{ $r->equipment_name }}</td>
            <td>{{ $r->category }}</td>
            <td>₱{{ number_format($r->unit_price, 2) }}</td>
            <td>{{ ucfirst($r->availability_status) }}</td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center text-muted">No records match the selected filters.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection