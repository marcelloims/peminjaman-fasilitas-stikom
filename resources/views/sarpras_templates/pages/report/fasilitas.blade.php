@extends('sarpras_templates.index')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data {{ $title }}</h4>
                    <a href="{{ url('/sarpras/laporan/fasilitas/print', []) }}" class="btn btn-primary">print</a>
                </div>
                <div class="card-body">
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
                                    @if (count($item->errorTools) < 0)
                                        @foreach ($item->errorTools as $key)
                                            <td>{{ !$key->error_qty ? '-' : $key->error_qty }}</td>
                                        @endforeach
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
