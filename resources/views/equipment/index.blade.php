<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pickleball Inventory')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="{{ route('equipment.index') }}">🏓 Pickleball Inventory</a>
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="{{ route('equipment.index') }}">Equipment</a>
            <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
</nav>
<div class="container py-4">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @yield('content')
</div>
</body>
</html>