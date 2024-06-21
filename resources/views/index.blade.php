@extends('layouts.app')
@section('title', 'Chat Interface')
@section('content')
    @include('layouts.header')
    @include('layouts.sidebar')

    <main id="main" class="main">
        <section class="section">
            <div class="row chat" id="chat-scrollable">
                <div class="col-lg-12 d-flex flex-column justify-content-end" id="chat-container">
                </div>
            </div>
        </section>
        <section id="input-message" class="p-2 pt-4 d-none">
            <div class="input-group">
                <label for="message"></label>
                <input type="text" id="message" class="form-control border-dark rounded-start"
                       placeholder="Type a new message here...">
                <button class="btn btn-outline-dark d-flex flex-column justify-content-evenly" id="upload-image"
                        type="button"><i class="bx bx-paperclip"></i></button>
                <button class="btn btn-outline-dark d-flex flex-column justify-content-evenly" id="send-message"
                        type="button"><i class="ri ri-send-plane-2-line"></i></button>
            </div>
            <input type="file" id="image-input" accept="image/*" class="d-none">
        </section>
    </main>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>
    <script>
        const conversations = @json($conversations);
        const userId = {{ Auth::id() }};
    </script>
    <script src="{{ asset('assets/js/socket.js') }}"></script>
@endsection
