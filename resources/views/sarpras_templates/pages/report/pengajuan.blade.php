@extends('sarpras_templates.index')
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="display min-w850">
                            <thead>
                                <div class="row">
                                    <form action="{{ url('sarpras/laporan/pengajuan/search', []) }}" method="POST">
                                        @csrf
                                        <div class="col-4">
                                            <input type="date" name="dateStart" class="form-control" value="">
                                        </div>
                                        <div class="col-4">
                                            <input type="date" name="dateEnd" class="form-control" value="">
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary"><i class="flaticon-381-search"></i> Cari</button>
                                        </div>
                                    </form>
                                </div>
                                <tr align="center">
                                    <th class="text-center">No</th>
                                    <th>Kode</th>
                                    <th>UKM</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
