<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
    <div class="app-shell">
        <main class="container py-5">
            <div class="hero-section">
                <h1>Salon Manager</h1>
                <p>One clean system for services, appointments, and payments.</p>
                <a href="{{ route('login') }}" class="btn btn-primary mt-3">Enter System</a>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h4>Services</h4>
                        <p class="mb-0">Manage your menu with simple CRUD actions.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card secondary">
                        <h4>Appointments</h4>
                        <p class="mb-0">Book customers with a clear schedule flow.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card accent">
                        <h4>Payments</h4>
                        <p class="mb-0">Record payment status and history in one place.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
