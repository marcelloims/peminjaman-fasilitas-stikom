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
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
