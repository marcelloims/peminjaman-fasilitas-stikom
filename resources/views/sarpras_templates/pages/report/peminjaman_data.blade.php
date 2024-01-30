@extends('sarpras_templates.index')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data {{ $title }}</h4>
                    <form action="{{ url('/sarpras/laporan/peminjaman/print', []) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-0">
                                <input type="hidden" id="datepicker"name="tahun" class="form-control" value="{{ $tahun }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </form>
                    {{-- <a href="{{ url('/sarpras/laporan/peminjaman/print', []) }}" class="btn btn-primary">print</a> --}}
                </div>
                <div class="card-body">
                    <form action="{{ url('sarpras/laporan/peminjaman/filter', []) }}" class="mb-4" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <input type="text" id="datepicker"name="tahun" class="form-control" value="{{ $tahun }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">cari</button>
                            </div>
                        </div>
                    </form>

                    <table id="" class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <td>No</td>
                                <td>Bulan Peminjaman</td>
                                <td>Total Peminjaman</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr align="center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @foreach ($month as $key => $value)
                                            @if ($key == $item->bulan)
                                                {{ $value; }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
