@extends('layouts.app')

@section('auth-content')
    <div class="auth-shell">
        <div class="auth-card">
            <h1>Salon Login</h1>
            @if ($errors->any())
                <div class="errors">
                    <ul style="margin: 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" class="stack">
                @csrf

                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div>
                    <label for="remember" style="display: flex; gap: 10px; align-items: center; font-weight: 400; margin: 0;">
                        <input id="remember" type="checkbox" name="remember" style="width: auto;">
                        Keep me signed in
                    </label>
                </div>

                <button class="btn" type="submit">Log In</button>
            </form>

        </div>
    </div>
@endsection
