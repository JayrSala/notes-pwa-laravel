@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background: #f5f7fb;
    }

    .app-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .note-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .note-input {
        border-radius: 12px;
    }

    .note-btn {
        border-radius: 12px;
    }

    textarea {
        resize: none;
    }

    .note-title {
        font-weight: 600;
        font-size: 18px;
    }

    .note-content {
        color: #555;
        white-space: pre-wrap;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }
</style>
</head>

<body>

    <div class="app-container">

        <!-- HEADER -->

        <div class="top-bar">
       

            <div>
                <h3 class="mb-0">My Notes</h3>
                <small class="text-muted">
                    {{ Auth::user()->name }}
                </small>
            </div>

          

                <button id="installBtn"
                    onclick="installApp()"
                    class="btn btn-dark btn-sm rounded-pill d-none">

                    Install App

                </button>

                <form method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button class="btn btn-outline-danger btn-sm rounded-pill">
                        Logout
                    </button>

                </form>

            </div>

            <!-- SUCCESS MESSAGE -->

            @if(session('success'))
            <div class="alert alert-success py-2">
                {{ session('success') }}
            </div>
            @endif

            <!-- ADD NOTE -->

            <div class="card note-card mb-4">
                <div class="card-body">

                    <form method="POST" action="{{ route('notes.store') }}">
                        @csrf

                        <input
                            type="text"
                            name="title"
                            class="form-control note-input mb-2"
                            placeholder="Note title"
                            required>

                        <textarea
                            name="content"
                            rows="3"
                            class="form-control note-input mb-3"
                            placeholder="Write something..."
                            required></textarea>

                        <button class="btn btn-dark w-100 note-btn">
                            Add Note
                        </button>

                    </form>

                </div>
            </div>

            <!-- NOTES -->

            @forelse($notes as $note)

            <div class="card note-card mb-3">
                <div class="card-body">

                    <form method="POST"
                        action="{{ route('notes.update', $note->id) }}">

                        @csrf
                        @method('PUT')

                        <input
                            type="text"
                            name="title"
                            value="{{ $note->title }}"
                            class="form-control note-input mb-2">

                        <textarea
                            name="content"
                            rows="3"
                            class="form-control note-input mb-3">{{ $note->content }}</textarea>

                        <div class="action-buttons">

                            <button class="btn btn-success btn-sm note-btn w-100">
                                Save
                            </button>

                    </form>

                    <form method="POST"
                        action="{{ route('notes.destroy', $note->id) }}"
                        class="w-100">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger btn-sm note-btn w-100">
                            Delete
                        </button>

                    </form>

                </div>

            </div>
        </div>

        @empty

        <div class="text-center text-muted mt-5">
            <h5>No notes yet</h5>
            <p>Create your first note.</p>
        </div>

        @endforelse

    </div>

    @endsection