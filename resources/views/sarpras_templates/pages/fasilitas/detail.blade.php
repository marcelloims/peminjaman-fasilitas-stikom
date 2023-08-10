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
                    <h4 class="card-title">Detail Data {{ $title }}</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div
                        class="form-group
                            @error('kode')
                                input-danger
                            @enderror">
                        <label for="">Kode</label>
                        <input type="text" name="kode" class="form-control input-default" placeholder="Masukan kode"
                            value="{{ $fasilitas->code }}" readonly>
                        @error('kode')
                            <span class="badge light badge-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div
                        class="form-group
                            @error('status')
                                input-danger
                            @enderror">
                        <label for="">Status</label>
                        <input type="text" name="status" class="form-control input-default" placeholder="Masukan status"
                            value="{{ $fasilitas->status }}" readonly>
                        @error('status')
                            <span class="badge light badge-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <a href="{{ url('sarpras/fasilitas', []) }}" class="btn btn-danger light float-right"
                        data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary light mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="flaticon-381-add-2 mr-2" id="title" data-flashdata="{{ $title }}"></i>
                Alat-alat
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Alat-alat</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('sarpras/fasilitas/fasilitas-save', []) }}" method="POST"
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
                                        placeholder="Masukan kode" value="#BRG-{{ $kode }}" readonly>
                                    <input type="hidden" name="fasilitas_id" class="form-control input-default"
                                        value="{{ $fasilitas->id }}" readonly>
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
                                        placeholder="Masukan nama" value="{{ old('nama') }}">
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
                                        placeholder="Masukan kategori" value="{{ old('kategori') }}">
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
                                        placeholder="Masukan jenis" value="{{ old('jenis') }}">
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
                                    <input type="number" min="1" name="jumlah"
                                        class="form-control input-default" placeholder="Masukan jumlah"
                                        value="{{ old('jumlah') }}">
                                    @error('jumlah')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Barang Per-{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tools as $tool)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tool->code }}</td>
                                        <td>{{ $tool->name }}</td>
                                        <td>{{ $tool->category }}</td>
                                        <td>{{ $tool->type }}</td>
                                        <td>{{ $tool->qty }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('sarpras/fasilitas/fasilitas-edit/' . $tool->id) }}"
                                                class="btn btn-sm btn-warning"><i class="flaticon-381-edit-1"></i></a>
                                            <a href="{{ url('sarpras/fasilitas/fasilitas-softdelete/' . $tool->id) }}"
                                                class="btn btn-sm btn-danger button-delete"><i
                                                    class="flaticon-381-trash"></i></a>
                                        </td>
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
