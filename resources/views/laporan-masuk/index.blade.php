@extends('index')


@section('content')
    <section id="#laporan">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-custom bg-info text-white h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h3>Total User</h3>
                        <h1>{{$total}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom bg-info text-white h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h3>Total Driver</h3>
                        <h1>{{$drive}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-custom bg-info text-white h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h3>Total Customer</h3>
                        <h1>{{$user}}</h1>
                    </div>
                </div>
            </div>
        </div>

        <h2>Laporan</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->user->id }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->kategori->name }}</td>
                            <td>{{ $item->title }}</td>
                            @if ($item->status == 'selesai')
                                <td><span class="badge badge-custom badge-selesai : 'badge-detail' ">Selesai</span>
                                </td>
                            @else
                                <td><a href="{{route('laporan-masuk.show',$item->id)}}" class="badge badge-custom  badge-detail text-light">Lihat detail</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </section>
@endsection
