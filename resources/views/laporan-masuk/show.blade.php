@extends('index')

@section('content')
    <section id="show">
        <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="row m-5 border rounded-2 " style="background: #E7F3F9

">
            @foreach ($data as $item)
                <div class="col-12 m-2 p-4 border-bottom">
                    <div class="row">
                        <div class="col-10">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/admin/default.png') }}" class="profile-image" alt="Profile">
                                <span
                                    class="ms-2">{{ $item->user->name }}<br><small>{{ $item->user->level }}</small></span>
                                @if ($item->status !== 'selesai')
                                    <span class="mb-2 ms-5"><a href="{{ route('laporan-masuk.show', $item->id) }}"
                                            class="badge badge-custom  badge-detail text-light">Lihat detail</a>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-2 text-end">
                            {{ $item->time }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ms-5">
                            <span class="text-muted">{{ $item->description }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
