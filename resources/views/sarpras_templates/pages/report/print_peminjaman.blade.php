<!DOCTYPE html>
<html lang="en">

<head>
    @include('sarpras_templates.header')
</head>

<body style="color: #000000 !important; font-family: 'Times New Roman', Times, serif">
    <div class="container">
        <table id="" class="table table-bordered" style="">
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
        <br><br><br><br><br>
        <div class="row" align="center">
            <div class="col-4">Diketahui</div>
            <div class="col-4">Disetujui</div>
            <div class="col-4">Mengetahui</div>
        </div>
        <br><br><br><br><br>
        <div class="row" align="center">
            <div class="col-4">Ni Nyoman Utami Januhari, SH., M.Kom</div>
            <div class="col-4">Nama</div>
            <div class="col-4">Nama</div>
        </div>
        <div class="row" align="center">
            <div class="col-4">Sarpras</div>
            <div class="col-4">Dir. Sumber Daya</div>
            <div class="col-4">Wakil Rektor II</div>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
