<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Pendaftaran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Data Laporan Pendaftaran</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Judul</th>
                <th>Pelaksanaan</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @forelse($pendaftarans as $pendaftaran)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pendaftaran->user->us_nama }}</td>
                    <td>{{ $pendaftaran->lomba->lb_judul }}</td>
                    <td>
                        @if ($pendaftaran->pd_pelaksaanaan == 0)
                            Offline
                        @elseif ($pendaftaran->pd_pelaksanaan == 1)                                        
                            Online
                        @endif
                    </td>
                    <td>{{ $pendaftaran->lomba->lb_lokasi }}</td>
                    <td>{{ \Carbon\Carbon::parse($pendaftaran->pd_tgldaftar)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Data Kosong!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
