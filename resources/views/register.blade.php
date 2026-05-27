@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow-sm border-0 rounded-4"
         style="max-width:420px; width:100%;">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                Create Account
            </h2>

            <p class="text-muted">
                Start using Notes App
            </p>

        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                @foreach ($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <form method="POST"
              action="{{ route('register') }}">

            @csrf

            <div class="mb-3">

                <input type="text"
                       name="name"
                       class="form-control rounded-3"
                       placeholder="Full name"
                       required>

            </div>

            <div class="mb-3">

                <input type="email"
                       name="email"
                       class="form-control rounded-3"
                       placeholder="Email"
                       required>

            </div>

            <div class="mb-3">

                <input type="password"
                       name="password"
                       class="form-control rounded-3"
                       placeholder="Password"
                       required>

            </div>

            <div class="mb-3">

                <input type="password"
                       name="password_confirmation"
                       class="form-control rounded-3"
                       placeholder="Confirm Password"
                       required>

            </div>

            <button class="btn btn-dark w-100 rounded-3">
                Register
            </button>

        </form>

        <div class="text-center mt-3">

            <small>

                Already have an account?

                <a href="{{ route('login.form') }}">
                    Login
                </a>

            </small>

        </div>

    </div>

</div>

@endsection