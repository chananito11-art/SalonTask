<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Salon Management System' }}</title>
    <style>
        :root {
            color-scheme: light;
            --rose: #c95c78;
            --rose-dark: #8f3650;
            --peach: #f3d7cd;
            --ink: #2f2430;
            --muted: #6f6670;
            --line: #e6d9d4;
            --surface: #fffaf8;
            --white: #ffffff;
            --green: #2f7d5b;
            --red: #b04b57;
            --shadow: 0 14px 35px rgba(110, 68, 83, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            background:
                radial-gradient(circle at top, rgba(201, 92, 120, 0.15), transparent 30%),
                linear-gradient(180deg, #fff9f6 0%, #fff3ee 100%);
            color: var(--ink);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .shell {
            min-height: 100vh;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255, 250, 248, 0.94);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(201, 92, 120, 0.12);
        }

        .topbar-inner,
        .content {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 0;
        }

        .brand h1 {
            margin: 0;
            font-size: 1.35rem;
        }

        .brand p {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .nav a,
        .nav button {
            border: 1px solid var(--line);
            background: var(--white);
            color: var(--ink);
            padding: 10px 14px;
            border-radius: 8px;
            font: inherit;
            cursor: pointer;
        }

        .nav a.active {
            background: var(--rose);
            color: var(--white);
            border-color: var(--rose);
        }

        .content {
            padding: 28px 0 40px;
        }

        .page-head {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 24px;
        }

        .page-head h2 {
            margin: 0;
            font-size: clamp(1.6rem, 3vw, 2.25rem);
        }

        .page-head p {
            margin: 8px 0 0;
            color: var(--muted);
            max-width: 700px;
            line-height: 1.5;
        }

        .btn,
        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 16px;
            border-radius: 8px;
            border: 1px solid var(--rose);
            background: var(--rose);
            color: var(--white);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--ink);
            border-color: var(--line);
        }

        .panel {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(201, 92, 120, 0.12);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 22px;
        }

        .grid {
            display: grid;
            gap: 20px;
        }

        .stats {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            margin-bottom: 24px;
        }

        .stat-value {
            font-size: 2rem;
            margin: 12px 0 4px;
        }

        .muted {
            color: var(--muted);
        }

        .flash {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 8px;
            background: #f7ebe7;
            border: 1px solid #edd3ca;
        }

        .errors {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 8px;
            background: #fff1f2;
            border: 1px solid #f2c4cb;
            color: #8d2f3d;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid var(--line);
            vertical-align: top;
        }

        th {
            font-size: 0.92rem;
            color: var(--muted);
            font-weight: 600;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.85rem;
            border: 1px solid transparent;
        }

        .badge-paid {
            color: var(--green);
            background: #edf8f1;
            border-color: #cae9d6;
        }

        .badge-unpaid {
            color: var(--red);
            background: #fff0f2;
            border-color: #f3c8d0;
        }

        .form-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .form-grid .full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border-radius: 8px;
            border: 1px solid #d8c8c2;
            background: var(--white);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .stack {
            display: grid;
            gap: 20px;
        }

        .empty {
            padding: 22px;
            border: 1px dashed var(--line);
            border-radius: 8px;
            text-align: center;
            color: var(--muted);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .auth-card {
            width: min(440px, 100%);
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(201, 92, 120, 0.15);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 28px;
        }

        .auth-card h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 2rem;
        }

        .auth-card p {
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 24px;
        }

        @media (max-width: 720px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .topbar-inner,
            .page-head {
                align-items: start;
            }
        }
    </style>
</head>
<body>
    @php
        $routeName = request()->route()?->getName();
    @endphp

    @if (auth()->check())
        <div class="shell">
            <header class="topbar">
                <div class="topbar-inner">
                    <div class="brand">
                        <h1>Salon Management</h1>
                    </div>

                    <nav class="nav">
                        <a href="{{ route('dashboard') }}" class="{{ $routeName === 'dashboard' ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('services.index') }}" class="{{ str_starts_with($routeName ?? '', 'services.') ? 'active' : '' }}">Services</a>
                        <a href="{{ route('appointments.index') }}" class="{{ str_starts_with($routeName ?? '', 'appointments.') ? 'active' : '' }}">Appointments</a>
                        <a href="{{ route('payments.index') }}" class="{{ str_starts_with($routeName ?? '', 'payments.') ? 'active' : '' }}">Payments</a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </nav>
                </div>
            </header>

            <main class="content">
                @if (session('status'))
                    <div class="flash">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="errors">
                        <ul style="margin: 0; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    @else
        @yield('auth-content')
    @endif
</body>
</html>
