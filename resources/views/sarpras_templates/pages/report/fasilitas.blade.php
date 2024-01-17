@extends('sarpras_templates.index')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data {{ $title }}</h4>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ url('sarpras/laporan/fasilitas/search', []) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <input type="date" name="dateStart" class="form-control" value="">
                            </div>
                            <div class="col-4">
                                <input type="date" name="dateEnd" class="form-control" value="">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary"><i class="flaticon-381-search"></i>
                                    Cari</button>
                            </div>
                        </div>
                    </form> --}}
                    <table id="" class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th class="text-center" rowspan="2" style="vertical-align: middle;"width="100px">No
                                </th>
                                <th rowspan="2" style="vertical-align: middle;" width="420px">Nama Barang</th>
                                <th align="center" colspan="2">Jumlah</th>
                            </tr>
                            <tr align="center">
                                <th width="300px">Baik</th>
                                <th width="300px">Hilang / Rusak</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ !$item->error_qty ? '-' : $item->error_qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
