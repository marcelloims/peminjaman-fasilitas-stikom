@extends('bem_templates.index')
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
                <form action="{{ url('bem/mahasiswa/update/' . $data->id, []) }}" method="post">
                    <div class="card-header">
                        <h4 class="card-title">Detail Data {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        @csrf
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
                                    @error('telepon')
                                        input-danger
                                    @enderror">
                            <label for="">Telepon</label>
                            <input type="text" name="telepon" class="form-control input-default"
                                placeholder="Masukan telepon" value="{{ $data->telephone }}">
                            @error('telepon')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div
                            class="form-group
                                    @error('email')
                                        input-danger
                                    @enderror">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control input-default"
                                placeholder="Masukan email" value="{{ $data->email }}">
                            @error('email')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div
                            class="form-group
                                @error('organisasi')
                                    input-danger
                                @enderror">
                            <label for="">Organisasi</label>
                            <select name="organisasi" id="" class="form-control">
                                @foreach ($ukms as $ukm)
                                    @if ($ukm->id == $data->student_organizations_id)
                                        <option value="{{ $ukm->id }}" selected>{{ $ukm->name }}</option>
                                    @else
                                        <option value="{{ $ukm->id }}">{{ $ukm->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('organisasi')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div
                            class="form-group
                                    @error('ttd')
                                        input-danger
                                    @enderror">
                            <label for="">Tanda Tangan</label>
                            <input type="file" name="ttd" class="form-control input-default"
                                placeholder="Masukan ttd" value="{{ old('ttd') }}">
                            @error('ttd')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kategori</label>
                            <select name="kategori"
                                class="form-control input-default
                                @error('kategori')
                                    input-danger
                                @enderror">
                                ">
                                @foreach ($kategori as $item)
                                    @if ($item == $data->category)
                                        <option value="{{ $item }}" selected>{{ $item }}</option>
                                    @else
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori')
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
                                @foreach ($status as $sts)
                                    @if ($sts == $data->status)
                                        <option value="{{ $sts }}" selected>{{ $sts }}</option>
                                    @else
                                        <option value="{{ $sts }}">{{ $sts }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('status')
                                <span class="badge light badge-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <a href="{{ url('bem/mahasiswa', []) }}" class="btn btn-danger light float-right"
                            data-dismiss="modal">Tutup</a>
                        <button type="submit" class="btn btn-primary light float-right mr-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
