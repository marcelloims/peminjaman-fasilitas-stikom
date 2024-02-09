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
                    <h4 class="card-title">Data {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('sarpras/persetujuan/aula/reset-update/') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{ $submission->id }}">
                        <div class="row">
                            <div class="col-4">
                                <div
                                    class="form-group
                        @error('tanggal_kegiatan_mulai')
                            input-danger
                        @enderror">
                                    <label for="">Tanggal Mulai Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan_mulai" class="form-control"
                                        value="{{ old('tanggal_kegiatan_mulai') }}" placeholder="Hari Bulan, Tahun">
                                    @error('tanggal_kegiatan_mulai')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="form-group
                        @error('jam_mulai')
                            input-danger
                        @enderror">
                                    <label for="">Jam Mulai</label>
                                    <input class="form-control" name="jam_mulai" value="08:00" readonly>
                                    @error('jam_mulai')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div
                                    class="form-group
                        @error('tanggal_kegiatan_selesai')
                            input-danger
                        @enderror">
                                    <label for="">Tanggal Selesai Kegiatan</label>
                                    <input type="date" name="tanggal_kegiatan_selesai" class="form-control"
                                        value="{{ old('tanggal_kegiatan_selesai') }}" placeholder="Hari Bulan, Tahun">
                                    @error('tanggal_kegiatan_selesai')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div
                                    class="form-group
                        @error('jam_selesai')
                            input-danger
                        @enderror">
                                    <label for="">Jam Selesai</label>
                                    <input class="form-control" name="jam_selesai" value="18:00" readonly>
                                    @error('jam_selesai')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
