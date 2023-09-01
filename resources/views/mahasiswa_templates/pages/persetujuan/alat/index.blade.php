@extends('mahasiswa_templates.index')
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
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tema</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $submission->name_of_activity }}</td>
                                        <td>{{ $submission->theme }}</td>
                                        <td>{{ date('d F Y H:i:s', strtotime($submission->date_start)) }}</td>
                                        <td>{{ date('d F Y H:i:s', strtotime($submission->date_end)) }}</td>
                                        <td>
                                            @if (!$submission->status)
                                                <span class="badge light badge-secondary">Tertunda</span>
                                            @elseif ($submission->status == 'Ditolak')
                                                <span class="badge light badge-danger">{{ $submission->status }}</span>
                                            @else
                                                <span class="badge light badge-success">{{ $submission->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('mahasiswa/persetujuan/alat/detail/' . $submission->id) }}"
                                                class="btn btn-sm btn-info"><i class="flaticon-381-list"></i></a>
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
