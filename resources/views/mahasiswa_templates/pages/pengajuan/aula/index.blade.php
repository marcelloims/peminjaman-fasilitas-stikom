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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Peminjaman</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('mahasiswa/pengajuan/aula/save', []) }}" method="POST"
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
                                        <input name="ketua_umum" class="form-control" placeholder="Nama ketua umum">
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
                                        <input name="ketua_panitia" class="form-control" placeholder="Nama Ketua Panitia">
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
                                        <input class="form-control" name="jam_selesai" value="18:00" readonly>
                                        @error('jam_selesai')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div
                                        class="form-group
                                        @error('ttd_1')
                                            input-danger
                                        @enderror">
                                        <label for="">TTD Ketua Umum</label>
                                        <input type="file" class="form-control" name="ttd_1">
                                        @error('ttd_2')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div
                                        class="form-group
                                    @error('ttd_1')
                                        input-danger
                                    @enderror">
                                        <label for="">TTD Ketua Panitia</label>
                                        <input type="file" class="form-control" name="ttd_2">
                                        @error('ttd_2')
                                            <span class="badge light badge-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary light">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Daftar Peminjaman Aula</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kode</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->name_of_activity }}</td>
                                        <td>{{ date('d F Y H:i:s', strtotime($data->date_start)) }}</td>
                                        <td>{{ date('d F Y H:i:s', strtotime($data->date_end)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
