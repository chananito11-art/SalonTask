@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-body p-5">
                <div class="mb-4">
                    <h2 class="mb-2">Salon Management System</h2>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
