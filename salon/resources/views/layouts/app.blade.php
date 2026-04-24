<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Salon Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app-shell">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ auth()->check() ? route('dashboard') : url('/') }}">
                    <span class="brand-mark">SM</span>
                    Salon Manager
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav mx-auto align-items-lg-center">
                        @auth
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Services</a>
                            <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">Appointments</a>
                            <a class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}" href="{{ route('payments.index') }}">Payments</a>
                        @endauth
                    </div>
                    <div class="ms-auto d-flex align-items-center gap-3">
                        @auth
                            <div class="top-user d-none d-lg-block">
                                <div>{{ auth()->user()->name }}</div>
                                <small>{{ auth()->user()->email }}</small>
                            </div>
                            <a class="btn-profile" href="{{ route('dashboard') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout">Log Out</button>
                            </form>
                        @else
                            <a class="btn-profile" href="{{ route('login') }}">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="container py-5">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer>
   
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
