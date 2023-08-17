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
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary light mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="flaticon-381-add-2 mr-2" id="title" data-flashdata="{{ $title }}"></i>
                {{ $title }}
            </button> --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah {{ $title }}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('mahasiswa/pengajuan/aula-alat/save', []) }}" method="POST"
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
                                            @error('tanggal_kegiatan_mulai')
                                                input-danger
                                            @enderror">
                                            <label for="">Tanggal Mulai Kegiatan</label>
                                            <input name="tanggal_kegiatan_mulai" class="datepicker-default form-control"
                                                id="datepicker" value="{{ old('tanggal_kegiatan_mulai') }}"
                                                placeholder="Hari Bulan, Tahun">
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
                                            <input name="tanggal_kegiatan_selesai" class="datepicker-default form-control"
                                                id="datepicker" value="{{ old('tanggal_kegiatan_selesai') }}"
                                                placeholder="Hari Bulan, Tahun">
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
                                                value="{{ old('jam_selesai') }}"
                                                placeholder="format: {{ date('H:i') }}">
                                            @error('jam_selesai')
                                                <span class="badge light badge-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary light">Simpan</button>
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="card-title">Data Alat-alat</h4>

    <div class="row">
        @foreach ($tools as $tool)
            @csrf
            <div class="col-xl-3">
                <form action="{{ url('mahasiswa/pengajuan/alat/save', []) }}" method="post"
                    enctype="multipart/form-data">
                    <div class="card text-center">
                        <div class="card-header">
                            <h6 class="card-title">{{ $tool->name }}</h6>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('logo_ukm/' . $tool->image) }}" width="150" height="150"
                                alt="logo-ukm" />
                        </div>
                        <div class="card-footer">
                            <input type="number" min="1" max="{{ $tool->qty }}" name="qty"
                                class="form-control" placeholder="Masukan Jumlah">
                            <span>Stok :{{ $tool->qty }}</span>
                            <button type="submit" class="btn btn-sm btn-primary ml-5 mt-2">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection
