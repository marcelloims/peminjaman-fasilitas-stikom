{{-- @extends('mahasiswa_templates.index')
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

            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    @include('mahasiswa_templates.header')
</head>

<body>
    <div class="container">
        <table align="center">
            <tr>
                <td>
                    <img src="{{ asset('logo_ukm/logo-stikom.png') }}" width="100" height="100" alt="logo-stikom"
                        class="mr-6" />
                </td>
                <td align="center" class="mt-2">
                    <h2>INSTITUT TEKNOLOGI DAN BISNIS</h2>
                    <h1>(ITB) STIKOM BALI</h1>
                    <h1>{{ $detailSubmissions->name }}</h1>

                </td>
                <td>
                    <img src="{{ asset('logo_ukm/' . $detailSubmissions->logoSubmissions) }}" align='right'
                        class="ml-3" width="100" height="100" alt="logo-ukm" />
                </td>
            </tr>
        </table>
        <hr>
        <div class="row">
            <div class="col-12" align='right'>
                <h4 style="font-size:18px">Denpasar, {{ $dateCreatedAt }}
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <h4 style="font-size:18px line-height:5px;">Nomor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:

                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mt-1">
                <h4 style="font-size:18px  line-height:5px">Lampiran &nbsp;&nbsp;&nbsp;: ... Lembar
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mt-1">
                <h4 style="font-size:18px line-height:5px; ">Perihal
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    <u>Peminjaman Alat dan Aula</u>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mt-5">
                <h4 style="font-size:18px; ">Yth.</h4>
                <h4 style="font-size:18px;">Wakil Rektor II ITB STIKOM Bali</h4>
                <h4><u>Dr. Ni Luh Sri Putrinadi, S.E., MM.Kom</u></h4>
                <h4>Di tempat</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <h4 style="font-size:18px; ">Dengan hormat,</h4>
                <p class="text-justify">
                    Dalam rangka melaksanakan Program Kerja {{ $detailSubmissions->name }} ITB STIKOM Bali periode 2023,
                    maka kami akan mengadakan kegiatan Nama Kegiatan ITB STIKOM Bali dengan tema
                    “{{ $detailSubmissions->theme }}” yang akan dilaksakan pada:
                    &nbsp; {{ $startDayActivity }} - {{ $endDayActivity }} ,
                    {{ $startDateActivity }} - {{ $endDateActivity }} {{ $endMonthActivity }}
                    {{ $endYearActivity }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <p class="text-justify">
                    Sehubung dengan itu, maka kami mohon peminjaman Aula beserta alat
                    (Terlampir) untuk tujuan peminjaman kegiatan tersebut pada:
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-justify ml-5">
                    Hari, tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $startDayActivity }} - {{ $endDayActivity }} ,
                    {{ $startDateActivity }} - {{ $endDateActivity }} {{ $endMonthActivity }}
                    {{ $endYearActivity }}
                    <br />
                </p>
                <p class="text-justify ml-5">Waktu
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    {{ date('H:i', strtotime($detailSubmissions->date_start)) }} -
                    {{ date('H:i', strtotime($detailSubmissions->date_end)) }} WITA
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-justify">
                    Demikian surat ini kami sampaikan, besar harapan kami kiranya dapat dikabulkan permohonan tersebut.
                    Atas perhatian Bapak, kami ucapkan terima kasih.
                </p>
            </div>
        </div>
        <div class="row" align="center">
            <div class="col-12 mt-3">
                <h4>Panitia Pelaksana</h4>
                <h4>{{ $detailSubmissions->name }}</h4>
                <h4>ITB STIKOM Bali</h4>
                <h4></h4>
            </div>
        </div>
        <table>
            <tr>
                <td align="left" width="500px">Diperiksa Oleh,
                    <p>{{ $chairman->category }}</p>
                    <p>{{ $detailSubmissions->name }}</p>
                </td>
                <td width="600px" align="right">Dibuat Oleh, <br />
                    <p>{{ $chairman_of_the_commitee->category }}</p>
                </td>
            </tr>
            <tr>
                <td width="500px" align="left">ttd</td>
                <td width="500px" align="right">ttd</td>
            </tr>
            <tr>
                <td width="500px" align="left">{{ $chairman->name }}</td>
                <td width="500px" align="right">{{ $chairman_of_the_commitee->name }}</td>
            </tr>
        </table>
        <div class="row" align="center">
            <div class="col-12 mt-3">
                <h4>Diketahui Oleh,</h4>
            </div>
        </div>
        <table>
            <tr>
                <td width="500px" align="left">
                    <p>ITB STIKOM Bali</p>
                    <p>Direktur Administrasi</p>
                    <p>Akademik dan Kemahasiswaan</p>
                </td>
                <td align="center">
                    <p>ITB STIKOM Bali</p>
                    <p>Koor. Bagian Kemahasiswaan</p>
                </td>
                <td width="600px" align="right">
                    <p>Disetujui Oleh,</p>
                    <p>BEM ITB STIKOM Bali</p>
                    <p>Ketua BEM</p>
                </td>
            </tr>
            <tr>
                <td width="500px" align="left">ttd</td>
                <td width="500px" align="center">ttd</td>
                <td width="500px" align="right">ttd</td>
            </tr>
            <tr>
                <td width="500px" align="left">nama</td>
                <td width="500px" align="center">nama</td>
                <td width="500px" align="right">nama</td>
            </tr>
        </table>
        <div class="row" align="left">
            <div class="col-12 mt-3">
                <ol>
                    <li>1. Direktur Sumber Daya ITB STIKOM Bali</li>
                    <li>2. Bagian Sarana dan Prasarana ITB STIKOM Bali</li>
                    <li>3. Arsip ORMAWA</li>
                </ol>
            </div>
        </div>
        <hr>
        <div class="row" align='center'>
            <div class="col-12">
                <h5>
                    Kampus I : Jl. Raya Puputan No. 86 Renon, Denpasar – Bali Telp. (0361)244445(Hunting) Fax.
                    (0361)264773
                </h5>
                <h5 class="mt-2">http://www.stikom-bali.ac.id Email : info@stikom-bali.ac.id</h5>
                <h5 class="mt-2">{{ $chairman->category }} : {{ $chairman->name }} ({{ $chairman->telephone }})
                </h5>
            </div>
        </div>
    </div>
</body>

</html>
