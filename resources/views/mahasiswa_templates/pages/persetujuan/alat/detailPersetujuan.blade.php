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
        <div class="row">
            <div class="col-12">
                <table align="center">
                    <tr>
                        <td>
                            <img src="{{ asset('logo_ukm/logo-stikom.png') }}" width="100" height="100"
                                alt="logo-stikom" class="mr-6" />
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
                        <h4 style="font-size:18px line-height:5px;">Nomor
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:

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
                            <u>Peminjaman Alat</u>
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
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam
                            rangka melaksanakan Program Kerja
                            {{ $detailSubmissions->name }} ITB STIKOM Bali
                            periode 2023,
                            maka kami akan mengadakan kegiatan Nama Kegiatan ITB STIKOM Bali dengan tema
                            @if ($startDayActivity == $endDayActivity)
                                “{{ $detailSubmissions->theme }}” yang akan dilaksakan pada:
                                {{ $endDayActivity }}, {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @else
                                “{{ $detailSubmissions->theme }}” yang akan dilaksakan pada:
                                &nbsp; {{ $startDayActivity }} - {{ $endDayActivity }} ,
                                {{ $startDateActivity }} - {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <p class="text-justify">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubung
                            dengan itu, maka kami mohon peminjaman alat
                            (Terlampir) untuk tujuan peminjaman kegiatan tersebut pada:
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="text-justify ml-5">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari,
                            tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: @if ($startDayActivity == $endDayActivity)
                                {{ $endDayActivity }}, {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @else
                                {{ $startDayActivity }} - {{ $endDayActivity }} ,
                                {{ $startDateActivity }} - {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @endif
                            <br />
                        </p>
                        <p class="text-justify ml-5">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{ date('H:i', strtotime($detailSubmissions->date_start)) }} -
                            {{ date('H:i', strtotime($detailSubmissions->date_end)) }} WITA
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="text-justify ml-2">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Demikian
                            surat ini kami sampaikan, besar harapan kami kiranya dapat dikabulkan permohonan tersebut.
                            Atas perhatian Bapak, kami ucapkan terima kasih.
                        </p>
                    </div>
                </div>
                <div class="row" align="center">
                    <div class="col-12 mt-3">
                        <h6>Panitia Pelaksana</h6>
                        <h4>"{{ $detailSubmissions->name_of_activity }}"</h4>
                        <h4>ITB STIKOM Bali</h4>
                        <h4>{{ $endYearActivity }}</h4>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">Diperiksa Oleh</div>
                    <div class="col-4"></div>
                    <div class="col-4">Dibuat Oleh</div>
                </div>
                <div class="row text-center">
                    <div class="col-4">{{ $chairman->category }}</div>
                    <div class="col-4"></div>
                    <div class="col-4">{{ $chairman_of_the_commitee->category }}</div>
                </div>
                <div class="row text-center mt-3 mb-3">
                    <div class="col-4"><img src="{{ asset('logo_ukm/' . $chairman_of_the_commitee->signature) }}"
                            width="50" height="50" alt="logo-ukm" /></div>
                    <div class="col-4"></div>
                    <div class="col-4"><img src="{{ asset('logo_ukm/' . $chairman_of_the_commitee->signature) }}"
                            width="50" height="50" alt="logo-ukm" /></div>
                </div>
                <div class="row text-center">
                    <div class="col-4">{{ $chairman->name }}</div>
                    <div class="col-4"></div>
                    <div class="col-4">{{ $chairman_of_the_commitee->name }}</div>
                </div>
                <div class="row text-center">
                    <div class="col-12 mt-5 mb-5">
                        <h6>Diketahui Oleh,</h6>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">ITB STIKOM Bali</div>
                    <div class="col-4">ITB STIKOM Bali</div>
                    <div class="col-4">ITB STIKOM Bali</div>
                </div>
                <div class="row text-center">
                    <div class="col-4">Direktur Administrasi <br />
                        Akademik dan Kemahasiswaan
                    </div>
                    <div class="col-4">Koor. Bagian Kemahasiswaan</div>
                    <div class="col-4">Ketua BEM</div>
                </div>
                <div class="row text-center mt-3 mb-3">
                    <div class="col-4"><img src="{{ asset('logo_ukm/' . $chairman_of_the_commitee->signature) }}"
                            width="50" height="50" alt="logo-ukm" /></div>
                    <div class="col-4"><img src="{{ asset('logo_ukm/' . $chairman_of_the_commitee->signature) }}"
                            width="50" height="50" alt="logo-ukm" /></div>
                    <div class="col-4"><img src="{{ asset('logo_ukm/' . $chairman_of_the_commitee->signature) }}"
                            width="50" height="50" alt="logo-ukm" /></div>
                </div>
                <div class="row text-center mt-3 mb-3">
                    <div class="col-4">{{ $akademik->name }}</div>
                    <div class="col-4">I G.N. Wikranta Arsa, S.Kom., M.Csd</div>
                    <div class="col-4">{{ $bem->name }}</div>
                </div>
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
                        <h5 class="mt-2">{{ $chairman_of_the_commitee->category }} :
                            {{ $chairman_of_the_commitee->name }}
                            ({{ $chairman_of_the_commitee->telephone }})
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
