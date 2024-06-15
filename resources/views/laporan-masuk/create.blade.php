@extends('index')

@section('content')
    <section id="show">
        <div class="row m-5 p-3 border rounded-2 " style="background: #E7F3F9;">
            <div class="col-12">
                <div class="row p-2 m-2" style="background:#00537D">
                    <div class="col-6">
                        <h5 class="text-light">{{ $data->user->name }}</h5>
                    </div>
                    <div class="col-6">
                        <h5 class="text-light text-end">{{ $data->user->id }}</h5>
                    </div>
                </div>
                <div class="row">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <ul>{{ $error }}</ul>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="row m-2">
                    <div class="mb-3 mt-3">

                        <textarea class="form-control" rows="2">{{ $data->kategori->name }}</textarea>
                    </div>

                </div>
                <div class="row m-2">
                    <div class="mb-3 ">

                        <textarea class="form-control" rows="2">{{ $data->title }}</textarea>
                    </div>

                </div>
                <div class="row m-2">
                    <div class="mb-3 ">

                        <input type="date" class="form-control" value="{{ $data->tanggal }}">
                    </div>

                </div>
                <div class="row m-2">
                    <div class="mb-3 ">

                        <textarea class="form-control" rows="2">{{ $data->drive }}</textarea>
                    </div>

                </div>
                <div class="row m-2">
                    <div class="mb-3 ">

                        <textarea class="form-control" rows="4">{{ $data->description }}</textarea>
                    </div>

                </div>
                <form action="{{ route('laporan-masuk.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="laporan_id" value="{{ $data->id }}">
                    <div class="row m-2">
                        <div class="col">
                            <h4>Tanggapan</h4>
                        </div>
                        <div class="mb-3 ">

                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="row d-flex justify-content-end m-2">
                        <div class="col-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-light border-primary ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
