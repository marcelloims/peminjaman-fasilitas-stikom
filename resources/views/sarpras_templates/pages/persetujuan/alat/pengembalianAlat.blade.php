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
                    <h4>Data Peminjaman</h4>
                    <table class="table table-border">
                        <tr align="center">
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                        </tr>
                        @foreach ($tools as $tool)
                            <tr>
                                <td align="center">{{ $loop->iteration }}</td>
                                <td>{{ $tool->name }}</td>
                                <td align="center">{{ $tool->qty }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    <h4>Data Pengembalian</h4>
                    <table class="table table-border">
                        <tr align="center">
                            <th align="center">No.</th>
                            <th>Nama Barang</th>
                            <th>Baik</th>
                            <th>Rusak/Hilang</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ($tools as $tool)
                            <form action="{{ url('sarpras/persetujuan/alat/update/' . $tool->id, []) }}" method="post">
                                @csrf
                                @if ($tool->status == 'Dipinjam')
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ $tool->name }}</td>
                                        <td width="150">
                                            <input type="hidden" name="tool_id" value="{{ $tool->tools_id }}">
                                            <input type="number"
                                                class="form-control
                                            @error('jumlah')
                                            input-danger
                                            @enderror"
                                                name="jumlah" id="" min="1" max="{{ $tool->qty }}"
                                                placeholder="jumlah">
                                            @error('jumlah')
                                                <span class="badge light badge-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td width="150">
                                            <input type="number"
                                                class="form-control
                                @error('rusak')
                                input-danger
                                @enderror"
                                                name="rusak" id="" min="0" max="{{ $tool->qty }}"
                                                placeholder="jumlah">
                                            @error('rusak')
                                                <span class="badge light badge-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-success">Unggah</button>
                                        </td>
                                    </tr>
                                @endif
                            </form>
                        @endforeach
                        @if ($tool->status != 'Dipinjam')
                            <tr class="text-center">
                                <td colspan="5" class="text-success">Barang Sudah Dikembalikan</td>
                            </tr>
                        @endif
                    </table>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
