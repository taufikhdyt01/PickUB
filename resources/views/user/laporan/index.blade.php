@extends('index')

@section('content')
    <section id="show">
        <div class="row m-5 p-3 border rounded-2 " style="background: #E7F3F9;">
            <form action="{{ route('laporan.store') }}" method="post">
                @csrf
                <div class="col-12">
                    <div class="row p-2 m-2" style="background:#00537D">
                        <div class="col-6">
                            <h5 class="text-light">Sampaikan laporan anda</h5>
                        </div>

                    </div>
                    <div class="row">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <ul>{{$error}}</ul>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row m-2">
                        <div class="mb-3 mt-3">
                            <select name="kategori_id" class="form-control">
                                <option selected>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row m-2">
                        <div class="mb-3 ">
                            <textarea class="form-control" name="title" placeholder="ketik Judul laporan anda" rows="2"></textarea>
                        </div>

                    </div>
                    <div class="row m-2">
                        <div class="mb-3 ">
                            <textarea class="form-control" name="description" placeholder="ketik isi laporan anda" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="row m-2">
                        <div class="mb-3 ">
                            <input type="date" name="tanggal" class="form-control" placeholder="Pilih tanggal kejadian">
                        </div>

                    </div>
                    <div class="row m-2">
                        <div class="mb-3 ">
                            <input type="text" name="drive" class="form-control" placeholder="drive terlapor">
                        </div>

                    </div>
                    <div class="row d-flex justify-content-end m-2">
                        <div class="col-3 d-flex justify-content-end">
                            <button class="btn btn-light border-primary ">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection
