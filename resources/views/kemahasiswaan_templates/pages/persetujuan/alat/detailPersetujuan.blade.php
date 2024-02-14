<!DOCTYPE html>
<html lang="en">

<head>
    @include('mahasiswa_templates.header')
</head>

<body style="color: #000000 !important; font-family: 'Times New Roman', Times, serif">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('signature/logo-stikom.png') }}" width="150" height="150" alt="logo-stikom"
                            class="mr-6" />
                    </div>
                    <div class="col-8 text-center">
                        <p style="font-size: 30px; font-weight: bold; height:30px">INSTITUT TEKNOLOGI DAN BISNIS</p>
                        <p style="font-size: 30px; font-weight: bold; height:30px">(ITB) STIKOM BALI</p>
                        <p style="font-size: 30px; font-weight: bold; height:30px">{{ $detailSubmissions->name }}</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ asset('signature/' . $detailSubmissions->logoSubmissions) }}" align='right'
                            class="ml-3" width="150" height="150" alt="logo-ukm" />
                    </div>
                </div>
                <hr style="border: 4px solid rgb(165, 165, 165);">
                <div class="row">
                    <div class="col-12" align='right'>
                        <p style="height:15px">Denpasar, {{ $dateCreatedAt }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <p style="height:15px">Nomor</p>
                    </div>
                    <p style="height:15px">:</p>
                    <div class="col-10 float-left">
                        <p style="height:15px">{{ $detailSubmissions->code }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <p style="height:15px">Lampiran</p>
                    </div>
                    <p style="height:15px">:</p>
                    <div class="col-10 float-left">
                        <p style="height:15px">1 Lembar</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <p style="height:15px">Perihal</p>
                    </div>
                    <p style="height:15px">:</p>
                    <div class="col-10 float-left">
                        <p style="height:15px"><u>Peminjaman Alat</u></p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <p style="height:5px">Yth.</p>
                        <strong>
                            <p style="height:5px">Wakil Rektor II ITB STIKOM Bali</p>
                            <p style="height:5px"><u>Dr. Ni Luh Sri Putrinadi, S.E., MM.Kom</u></p>
                        </strong>
                        <p style="height:5px">Di tempat</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <p style="height:15px">Dengan hormat,</p>
                    </div>
                    <div class="col-12 mt-3">
                        <p class="text-justify" style="height:15px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dalam
                            rangka
                            melaksanakan Program Kerja
                            {{ $detailSubmissions->name }}
                            ITB STIKOM Bali periode 2023, maka kami akan mengadakan kegiatan
                            <strong>{{ $detailSubmissions->name_of_activity }}</strong> ITB STIKOM
                            Bali
                            dengan tema <strong>“{{ $detailSubmissions->theme }}”</strong> yang akan
                            dilaksakan pada: @if ($startDayActivity == $endDayActivity)
                                {{ $endDayActivity }}, {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @else
                                &nbsp; {{ $startDayActivity }} - {{ $endDayActivity }} ,
                                {{ $startDateActivity }} - {{ $endDateActivity }} {{ $endMonthActivity }}
                                {{ $endYearActivity }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <p class="text-justify" style="height:15px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sehubung
                            dengan itu, maka kami mohon peminjaman alat (Terlampir) untuk tujuan
                            peminjaman kegiatan tersebut pada:
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <p class="text-justify" style="height:15px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari,
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
                        <p class="text-justify ml-5" style="height:15px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            {{ date('H:i', strtotime($detailSubmissions->date_start)) }} -
                            {{ date('H:i', strtotime($detailSubmissions->date_end)) }} WITA
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <p class="text-justify ml-2">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Demikian
                            surat ini kami sampaikan, besar harapan kami kiranya dapat dikabulkan permohonan tersebut.
                            Atas perhatian Bapak, kami ucapkan terima kasih.
                        </p>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12 text-center">
                        <p style="height:5px;">Panitia Pelaksana</p>
                        <strong>
                            <p style="height:5px;">"{{ $detailSubmissions->name_of_activity }}"</p>
                            <p style="height:5px;">ITB STIKOM Bali</p>
                            <p style="height:5px;">{{ $endYearActivity }}</p>
                        </strong>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-4">Diperiksa Oleh</div>
                    <div class="col-4"></div>
                    <div class="col-4">Dibuat Oleh</div>
                </div>
                <div class="row text-center">
                    <div class="col-4">Ketua Umum</div>
                    <div class="col-4"></div>
                    <div class="col-4">Ketua Panitia</div>
                </div>
                <div class="row text-center">
                    <div class="col-4">{!! DNS2D::getBarcodeSVG(asset('signature/' . $detailSubmissions->ttd_1), 'QRCODE') !!}</div>
                    <div class="col-4"></div>
                    <div class="col-4">{!! DNS2D::getBarcodeSVG(asset('signature/' . $detailSubmissions->ttd_2), 'QRCODE') !!}</div>
                </div>
                <div class="row text-center">
                    <div class="col-4">{{ $detailSubmissions->chairman }}</div>
                    <div class="col-4"></div>
                    <div class="col-4">{{ $detailSubmissions->chairman_of_the_commitee }}</div>
                </div>
                <div class="row text-center mt-1">
                    <div class="col-12">
                        <p>Diketahui Oleh,</p>
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
                    <div class="col-4">
                        @if ($detailSubmissions->assign_4 == 'Disetujui')
                            {!! DNS2D::getBarcodeSVG(asset('signature/' . $akademik->signature), 'QRCODE') !!}
                        @endif
                    </div>
                    <div class="col-4">
                        @if ($detailSubmissions->assign_5 == 'Disetujui')
                            {!! DNS2D::getBarcodeSVG(asset('signature/' . $kemahasiswaan->signature), 'QRCODE') !!}
                        @endif
                    </div>
                    <div class="col-4">
                        @if ($detailSubmissions->assign_2 == 'Disetujui')
                            {!! DNS2D::getBarcodeSVG(asset('signature/' . $bem->signature), 'QRCODE') !!}
                        @endif
                    </div>
                </div>
                <div class="row text-center mt-3 mb-3">
                    <div class="col-4">{{ $akademik->name }}</div>
                    <div class="col-4">{{ $kemahasiswaan->name }}</div>
                    <div class="col-4">{{ $bem->name }}</div>
                </div>
                <div class="row" align="left">
                    <div class="col-12">
                        <ol>
                            <li>1. Direktur Sumber Daya ITB STIKOM Bali</li>
                            <li>2. Bagian Sarana dan Prasarana ITB STIKOM Bali</li>
                            <li>3. Arsip ORMAWA</li>
                        </ol>
                    </div>
                </div>
                <hr style="border: 2px solid rgb(165, 165, 165);">
                <div class="row" align='center'>
                    <div class="col-12">
                        <p style="height: 5px;">
                            Kampus I : Jl. Raya Puputan No. 86 Renon, Denpasar – Bali Telp. (0361)244445(Hunting) Fax.
                            (0361)264773
                        </p>
                        <p style="height: 5px; color: #65c9f4;" class="mt-2">http://www.stikom-bali.ac.id Email :
                            info@stikom-bali.ac.id</p>
                        <p style="height: 5px;" class="mt-2">Ketua Panitia :
                            {{ $detailSubmissions->chairman_of_the_commitee }}
                            {{-- ({{ $chairman_of_the_commitee->telephone }}) --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('signature/logo-stikom.png') }}" width="150" height="150"
                            alt="logo-stikom" class="mr-6" />
                    </div>
                    <div class="col-8 text-center">
                        <p style="font-size: 30px; font-weight: bold; height:30px">INSTITUT TEKNOLOGI DAN BISNIS</p>
                        <p style="font-size: 30px; font-weight: bold; height:30px">(ITB) STIKOM BALI</p>
                        <p style="font-size: 30px; font-weight: bold; height:30px">{{ $detailSubmissions->name }}</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ asset('signature/' . $detailSubmissions->logoSubmissions) }}" align='right'
                            class="ml-3" width="150" height="150" alt="logo-ukm" />
                    </div>
                </div>
                <hr style="border: 4px solid rgb(165, 165, 165);">
                <div class="row text-black" style="height:1200px;">
                    <div class="col-12 ml-4">
                        Daftar Alat:
                        <div class="col-12 ml-5">
                            <table>
                                @foreach ($tools as $item)
                                    <tr>
                                        <td width="20px">{{ $loop->iteration }}.</td>
                                        <td width="150px">{{ $item->name }}</td>
                                        <td width="20px">:</td>
                                        <td>{{ $item->qty }} buah</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <hr style="border: 2px solid rgb(165, 165, 165);">
                <div class="row" align='center'>
                    <div class="col-12">
                        <p style="height: 5px;">
                            Kampus I : Jl. Raya Puputan No. 86 Renon, Denpasar – Bali Telp. (0361)244445(Hunting) Fax.
                            (0361)264773
                        </p>
                        <p style="height: 5px; color: #65c9f4;" class="mt-2">http://www.stikom-bali.ac.id Email :
                            info@stikom-bali.ac.id</p>
                        <p style="height: 5px;" class="mt-2">Ketua Panitia :
                            {{ $detailSubmissions->chairman_of_the_commitee }}
                            {{-- ({{ $chairman_of_the_commitee->telephone }}) --}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
