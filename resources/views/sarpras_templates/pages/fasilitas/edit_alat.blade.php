@extends('sarpras_templates.index')
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
                    <form action="{{ url('sarpras/fasilitas/fasilitas-update/' . $data->id, []) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div
                                class="form-group
                                @error('kode')
                                    input-danger
                                @enderror">
                                <label for="">Kode</label>
                                <input type="text" name="kode" class="form-control input-default"
                                    placeholder="Masukan kode" value="{{ $data->code }}" readonly>

                                <input type="hidden" name="fasilitas_id" class="form-control input-default"
                                    value="{{ $data->facilities_id }}" readonly>
                                @error('kode')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="form-group
                                @error('nama')
                                    input-danger
                                @enderror">
                                <label for="">Nama</label>
                                <input type="text" name="nama" class="form-control input-default"
                                    placeholder="Masukan nama" value="{{ $data->name }}">
                                @error('nama')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="form-group
                                @error('kategori')
                                    input-danger
                                @enderror">
                                <label for="">Kategori</label>
                                <input type="text" name="kategori" class="form-control input-default"
                                    placeholder="Masukan kategori" value="{{ $data->category }}">
                                @error('kategori')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="form-group
                                @error('jenis')
                                    input-danger
                                @enderror">
                                <label for="">Jenis</label>
                                <input type="text" name="jenis" class="form-control input-default"
                                    placeholder="Masukan jenis" value="{{ $data->type }}">
                                @error('jenis')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="form-group
                                @error('jumlah')
                                    input-danger
                                @enderror">
                                <label for="">Jumlah</label>
                                <input type="number" min="1" name="jumlah" class="form-control input-default"
                                    placeholder="Masukan jumlah" value="{{ $data->qty }}">
                                @error('jumlah')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div
                                class="form-group
                                    @error('gambar')
                                        input-danger
                                    @enderror">
                                <label for="">Gambar</label>
                                <input type="file" name="gambar" class="form-control input-default"
                                    placeholder="Masukan gambar" value="{{ old('gambar') }}">
                                @error('gambar')
                                    <span class="badge light badge-danger">{{ $message }}</span>
                                @enderror
                                <img src="{{ asset('logo_ukm/' . $data->image) }}" width="300" height="300"
                                    alt="logo-ukm" />
                            </div>
                        </div>
                        <a href="{{ url('sarpras/fasilitas/detail/' . $data->facilities_id, []) }}"
                            class="btn btn-danger light float-right" data-dismiss="modal">Tutup</a>
                        <button type="submit" class="btn btn-primary light float-right mr-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
