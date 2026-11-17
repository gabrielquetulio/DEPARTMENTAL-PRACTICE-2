<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background: #198754; color: #fff; }
</style>
</head>
<body>
<h2>{{ $title }}</h2>
<table>
    <tr><th>Name</th><th>Category</th><th>Unit Price</th><th>Status</th></tr>
    @forelse($rows as $r)
        <tr>
            <td>{{ $r->equipment_name }}</td>
            <td>{{ $r->category }}</td>
            <td>PHP {{ number_format($r->unit_price, 2) }}</td>
            <td>{{ ucfirst($r->availability_status) }}</td>
        </tr>
    @empty
        <tr><td colspan="4">No records match the selected filters.</td></tr>
    @endforelse
</table>
</body>
</html>