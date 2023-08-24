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
    @if ($carts->count() != 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data List {{ $title }}</h4>
                        <h4 class="card-title">Total Alat : {{ $totalQty }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">No</th>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $cart->name }}</td>
                                            <td class="text-center"><img
                                                    src="{{ asset('logo_ukm/' . $cart->attributes->image) }}" width="50"
                                                    height="50" alt="logo-ukm" /></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <div class="col-2 mt-2">
                                                        {{ $cart->quantity }}
                                                    </div>
                                                    <div class="col-1 mr-3">
                                                        @if ($cart->quantity > 1)
                                                            <form
                                                                action="{{ url('mahasiswa/pengajuan/alat/subtract/' . $cart->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="stok"
                                                                    value="{{ $cart->attributes->stock }}">
                                                                <button type="submit" class="btn btn-sm btn-success mr-3">
                                                                    <i class="flaticon-381-substract-2"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($cart->quantity < $cart->attributes->stock)
                                                            <form
                                                                action="{{ url('mahasiswa/pengajuan/alat/addedCart/' . $cart->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="stok"
                                                                    value="{{ $cart->attributes->stock }}">
                                                                <button type="submit" class="btn btn-sm btn-success mr-3">
                                                                    <i class="flaticon-381-add-1"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ url('mahasiswa/pengajuan/alat/deletedCart/' . $cart->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="stok"
                                                        value="{{ $cart->attributes->stock }}">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="flaticon-381-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('mahasiswa/pengajuan/alat', []) }}" class="btn btn-info float-right">Tambah Alat
                            Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Peminjam</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('mahasiswa/pengajuan/alat/save', []) }}" method="POST"
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
                                                value="{{ old('tanggal_kegiatan_mulai') }}"
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
                                                value="{{ old('tanggal_kegiatan_selesai') }}"
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger solid alert-dismissible fade show">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2"
                fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                </polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>Kesalahan!</strong> Anda belum menambahkan alat.
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
        </div>
        <a href="{{ url('mahasiswa/pengajuan/alat', []) }}" class="btn btn-info light float-right mr-2"
            data-dismiss="modal">Tambah Alat</a>
    @endif

@endsection
