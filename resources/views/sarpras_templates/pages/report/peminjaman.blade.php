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

                    <form action="" class="mb-4">
                        <div class="row">
                            <div class="col-4">
                                <input type="date" name="tahun" class="form-control">
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
