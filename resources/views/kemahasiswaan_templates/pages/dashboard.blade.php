@extends('kemahasiswaan_templates.index')
@section('container')
    <div class="row">
        <div class="col-12">
            <h4>{{ $title }}</h4>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-head mt-1 mb-1 ml-1 mr-1">
                    <h5>Total Pengajuan Peminjaman</h5>
                </div>
                <div class="card-body">
                    @foreach ($ukms as $ukm)
                        <div class="row mr-1 ml-1 mt-1 mb-1">
                            <div class="col-4">{{ $ukm->name }}</div>
                            <div class="col-4">:</div>
                            <div class="col-2">{{ $ukm->submissions->count() }}</div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
