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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary light mb-2" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="flaticon-381-add-2 mr-2" id="title" data-flashdata="{{ $title }}"></i>
                {{ $title }}
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah {{ $title }}</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('sarpras/organisasi-mahasiswa/save', []) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
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
                                    @error('logo')
                                        input-danger
                                    @enderror">
                                    <label for="">Logo</label>
                                    <input type="file" name="logo" class="form-control input-default"
                                        placeholder="Masukan logo" value="{{ old('logo') }}">
                                    @error('logo')
                                        <span class="badge light badge-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status"
                                        class="form-control input-default
                                        @error('status')
                                            input-danger
                                        @enderror">
                                        ">
                                        <option disabled selected>Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                    @error('status')
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
                    <h4 class="card-title">Data {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th class="text-center">logo</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ukms as $ukm)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $ukm->name }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('logo_ukm/' . $ukm->logo) }}" width="50" height="50"
                                                alt="logo-ukm" />
                                        </td>
                                        <td class="text-center">
                                            @if ($ukm->status == 'Aktif')
                                                <span class="badge light badge-success">{{ $ukm->status }}</span>
                                            @else
                                                <span class="badge light badge-danger">{{ $ukm->status }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- <a href="{{ url('sarpras/organisasi-mahasiswa/' . $ukm->id, []) }}"
                                                class="btn btn-sm btn-info"><i class="flaticon-381-list"></i></a> --}}
                                            <a href="{{ url('sarpras/organisasi-mahasiswa/edit/' . $ukm->id, []) }}"
                                                class="btn btn-sm btn-warning"><i class="flaticon-381-edit-1"></i></a>
                                            <a href="{{ url('sarpras/organisasi-mahasiswa/softdelete/' . $ukm->id) }}"
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
