@extends('kemahasiswaan_templates.index')
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Ubah {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('kemahasiswaan/organisasi-mahasiswa/update/' . $ukm->id, []) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div
                            class="form-group
                                    @error('nama')
                                        input-danger
                                    @enderror">
                            <label for="">Nama</label>
                            <input type="text" name="nama" class="form-control input-default"
                                placeholder="Masukan nama" value="{{ $ukm->name }}">
                            @error('nama')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div
                            class="form-group
                                    @error('logo')
                                        input-danger
                                    @enderror">
                            <label for="">Logo</label>
                            <input type="file" name="logo" class="form-control input-default"
                                placeholder="Masukan logo">
                            @error('logo')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                            <img src="{{ asset('logo_ukm/' . $ukm->logo) }}" width="50" alt="logo-ukm" />
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status"
                                class="form-control input-default
                                        @error('status')
                                            input-danger
                                        @enderror">
                                ">
                                @foreach ($status as $item)
                                    @if ($item == $ukm->status)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <a href="{{ url('kemahasiswaan/organisasi-mahasiswa', []) }}"
                            class="btn btn-danger light float-right" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="btn btn-primary light float-right mr-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
