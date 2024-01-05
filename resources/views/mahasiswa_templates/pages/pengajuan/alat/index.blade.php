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
    @if ($error = Session::get('error'))
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                </polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>Kesalahan!</strong> {{ $error }}.
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
        </div>
    @endif
    <form action="{{ url('mahasiswa/pengajuan/alat/search/date', []) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
            @csrf
            <div class="col-3">
                <div
                    class="form-group
                    @error('tanggal_kegiatan_mulai')
                    input-danger
                    @enderror"
                >
                    <label for="">Tanggal Mulai Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan_mulai"
                        class="datepicker-default form-control" id="datepicker"
                        value="{{ old('tanggal_kegiatan_mulai') }}"
                        placeholder="Hari Bulan, Tahun"
                    >
                        @error('tanggal_kegiatan_mulai')
                        <span class="badge light badge-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-3">
                <div
                    class="form-group
                    @error('tanggal_kegiatan_mulai')
                    input-danger
                    @enderror"
                >
                    <label for="">Tanggal Mulai Selesai</label>
                    <input type="date" name="tanggal_kegiatan_selesai"
                        class="datepicker-default form-control" id="datepicker"
                        value="{{ old('tanggal_kegiatan_selesai') }}"
                        placeholder="Hari Bulan, Tahun"
                    >
                        @error('tanggal_kegiatan_mulai')
                        <span class="badge light badge-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary mt-3"><i class="flaticon-381-search-1 mr-2"></i>Cari</button>
            </div>
        </div>
    </form>
@endsection
