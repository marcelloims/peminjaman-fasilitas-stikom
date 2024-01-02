<!DOCTYPE html>
<html lang="en">

<head>
    @include('sarpras_templates.header')
</head>

<body style="color: #000000 !important; font-family: 'Times New Roman', Times, serif">
    <div class="container">
        <table id="" class="table table-border" border="1">
            <thead>
                <tr align="center">
                    <th class="text-center">No</th>
                    <th>Kode</th>
                    <th>UKM</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td align="center">{{$loop->iteration}}</td>
                        <td>{{$item->code}}</td>
                        <td align="center">{{$item->name}}</td>
                        <td align="center">{{date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td align="center">{{$item->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 mb-5 ml-5">Disetujui</div>
            <div class="col-12 mt-5">____________________</div>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
