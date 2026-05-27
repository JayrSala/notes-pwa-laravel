@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow-sm border-0 rounded-4"
         style="max-width:400px; width:100%;">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                Notes App
            </h2>

            <p class="text-muted">
                Login to continue
            </p>

        </div>

        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="alert alert-danger">

                @foreach ($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <form method="POST"
              action="{{ route('login') }}">

            @csrf

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

            <button class="btn btn-dark w-100 rounded-3">
                Login
            </button>

        </form>

        <div class="text-center mt-3">

            <small>

                No account?

                <a href="{{ route('register.form') }}">
                    Register
                </a>

            </small>

        </div>

    </div>

</div>

@endsection