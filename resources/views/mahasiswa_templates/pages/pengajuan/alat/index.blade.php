@extends('mahasiswa_templates.index')
@section('container')
    @if ($errors->all())
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                </polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>Kesalahan!</strong> Data data tidak valid! Silahkan liat form pengisian.
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('message'))
        <div class="sweetalert sweet-success" id="flash-data" data-flashdata="{{ $message }}">
        </div>
    @endif
    <div class="row">
        <div class="col-6 col-sm-6">
            <h4 class="card-title">Data Alat-alat</h4>
        </div>
        <div class="col-6 col-sm-6">
            <span class="card-title float-right text-white badge-info"><i
                    class="
                flaticon-381-bookmark-1"></i> Daftar Alat : {{ $totalCart }} item</span>
        </div>
    </div>

    <div class="row">
        @foreach ($tools as $tool)
            @csrf
            <div class="col-xl-3">
                <form action="{{ url('mahasiswa/pengajuan/alat/addToCart/' . $tool->id, []) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card text-center">
                        <div class="card-header">
                            <h6 class="card-title">{{ $tool->name }}</h6>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('logo_ukm/' . $tool->image) }}" width="150" height="150"
                                alt="logo-ukm" />
                        </div>
                        <div class="card-footer">
                            <div
                                class="form-group
                                @error('qty')
                                    input-danger
                                @enderror">
                                <input type="number" min="1" max="{{ $tool->qty }}" name="qty"
                                    class="form-control" placeholder="Masukan Jumlah">
                                @error('qty')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                                <span>Stok :{{ $tool->qty }}</span>
                                <button type="submit" class="btn btn-sm btn-primary ml-5 mt-2">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection
