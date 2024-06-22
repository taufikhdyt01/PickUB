@extends('layouts.app')
@section('title', 'New Conversation Interface')
@section('content')
    @include('layouts.header-new')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Available user</h1>
        </div>
        <section class="section mt-3">
            <div class="row">
                @if(isset($usersWithoutConversations))
                    @foreach($usersWithoutConversations as $user)
                        <div class="col-lg-3">
                            <div class="card">
                                <img src="{{asset($user->image_url)}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center p-2 pb-0">{{$user->name}}</h5>
                                    <p class="text-center text-secondary">{{$user->username}}</p>
                                    <form action="{{ url('/conversations') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-outline-secondary w-100">Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </main>
@endsection
