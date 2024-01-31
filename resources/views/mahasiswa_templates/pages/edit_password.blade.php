@extends('mahasiswa_templates.index')
@section('container')
    <div class="row">
        <div class="col-12">
            <h4>{{ $title }}</h4>
        </div>
        @if ($message = Session::get('message'))
            <div class="sweetalert sweet-success" id="flash-data" data-flashdata="{{ $message }}">
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="sweetalert sweet-success" id="flash-data-error" data-flashdata="{{ $message }}">
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('mahasiswa/updatepassword', []) }}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="{{ $id }}">

                        <div class="form-group">
                            <label for="">Kata Sandi Lama</label>
                            <input type="password" class="form-control" name="password_lama" id="" required
                                placeholder="masukan sandi lama">
                        </div>
                        <div class="form-group">
                            <label for="">Kata Sandi</label> Baru</label>
                            <input type="password" class="form-control" name="password_baru" id="" required
                                placeholder="masukan sandi baru" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbaharui Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
