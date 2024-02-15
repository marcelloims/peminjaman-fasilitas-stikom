<!DOCTYPE html>
<html lang="en">

<head>
    @include('sarpras_templates.header')
</head>

<body style="color: #000000 !important; font-family: 'Times New Roman', Times, serif">
    <div class="container">
        <?php date_default_timezone_set('Asia/Singapore'); ?>
        <h4>Tanggal Laporan : {{ date('d-m-Y') }}</h4>
        <table id="" class="table table-bordered" style="">
            <thead>
                <tr align="center">
                    <th class="text-center" rowspan="2" style="vertical-align: middle;"width="100px">No
                    </th>
                    <th rowspan="2" style="vertical-align: middle;" width="420px">Nama Barang</th>
                    <th align="center" colspan="2">Jumlah</th>
                    <th rowspan="2" style="vertical-align: middle;" width="420px">Total Barang</th>
                </tr>
                <tr align="center">
                    <th width="300px">Baik</th>
                    <th width="300px">Hilang / Rusak</th>
                </tr>
            </thead>
            <tbody>
                <?php $qtyError = 0; ?>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        @if (count($item->errorTools) > 0)
                            @foreach ($item->errorTools as $key)
                                <td class="text-center">{{ $key->qty }}</td>
                                <?php $qtyError = $key->qty; ?>
                            @endforeach
                        @else
                            <?php $qtyError = count($item->errorTools); ?>
                            <td class="text-center">{{ $qtyError }}</td>
                        @endif
                        <td class="text-center">{{ $item->qty - $qtyError }}</td>
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
