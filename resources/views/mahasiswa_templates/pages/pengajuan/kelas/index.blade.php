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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Peminjaman</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('mahasiswa/pengajuan/kelas/save', []) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div
                                        class="form-group
                                @error('ketua_umum')
                                    input-danger
                                @enderror">
                                        <label for="">Ketua Umum</label>
                                        <select name="ketua_umum" class="form-control">
                                            <option disabled selected>-- Pilih Ketua Umum --</option>
                                            @foreach ($chairmans as $chairman)
                                                <?php
                                                $nim = explode('_', $chairman->email);
                                                ?>
                                                <option value="{{ $chairman->id }}"
                                                    {{ old('ketua_umum') == $chairman->id ? 'selected' : '' }}>
                                                    {{ $nim[0] }} -
                                                    {{ $chairman->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ketua_umum')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                @error('ketua_panitia')
                                    input-danger
                                @enderror">
                                        <label for="">Ketua Panitia</label>
                                        <select name="ketua_panitia" class="form-control">
                                            <option disabled selected>-- Pilih Ketua Panitia --</option>
                                            @foreach ($chairmans as $chairman)
                                                <?php
                                                $nim = explode('_', $chairman->email);
                                                ?>
                                                <option value="{{ $chairman->id }}"
                                                    {{ old('ketua_panitia') == $chairman->id ? 'selected' : '' }}>
                                                    {{ $nim[0] }} -
                                                    {{ $chairman->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ketua_panitia')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                @error('nama_kegiatan')
                                    input-danger
                                @enderror">
                                        <label for="">Nama Kegiatan</label>
                                        <input type="text" name="nama_kegiatan" class="form-control input-default"
                                            placeholder="Masukan nama kegiatan" value="{{ old('nama_kegiatan') }}">
                                        @error('nama_kegiatan')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div
                                        class="form-group
                                @error('tanggal_kegiatan_mulai')
                                    input-danger
                                @enderror">
                                        <label for="">Tanggal Mulai Kegiatan</label>
                                        <input type="date" name="tanggal_kegiatan_mulai"
                                            class="datepicker-default form-control" id="datepicker"
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
                                    <div
                                        class="form-group
                                @error('tema')
                                    input-danger
                                @enderror">
                                        <label for="">Tema Kegiatan</label>
                                        <input type="text" name="tema" class="form-control input-default"
                                            placeholder="Masukan nama kegiatan" value="{{ old('tema') }}">
                                        @error('tema')
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
                                        <input type="date" name="tanggal_kegiatan_selesai"
                                            class="datepicker-default form-control" id="datepicker"
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
                                        <input class="form-control" name="jam_selesai" id="single-input"
                                            value="{{ old('jam_selesai') }}" placeholder="format: {{ date('H:i') }}">
                                        @error('jam_selesai')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group
                                @error('kelas')
                                    input-danger
                                @enderror">
                                        <label for="">Ruang Kelas</label>
                                        <select name="kelas" id="" class="form-control">
                                            <option selected disabled>--Pilih--</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->code }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary light">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
