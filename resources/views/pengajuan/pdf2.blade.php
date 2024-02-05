<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Laporan Pengajuan</title>
    <style>
        /* Style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
    
</head>
<body>

    <h1>Data Laporan Pengajuan</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Lomba</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">Dosen Pembimbing</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Alasan</th>
                <th scope="col">Status Pengajuan</th>
                <th scope="col">Hasil Revisi</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1 @endphp
            @forelse($pengajuans as $pendaftaran)
            <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pendaftaran->lomba->lb_judul }}</td>
                                        <td>{{ $pendaftaran->user->us_nama }}</td>
                                        <td>{{ $pendaftaran->dosen->us_nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pendaftaran->pn_tglpengajuan)->format('d/m/Y') }}</td>
                                        <td>{{ $pendaftaran->pn_revisimahasiswa }}</td>     
                                        <td>
                                            @if ($pendaftaran->pn_status == 1)
                                                Menunggu Konfirmasi
                                            @elseif ($pendaftaran->pn_status == 2)                                        
                                                Diterima
                                            @elseif ($pendaftaran->pn_status == 3)                                        
                                                Selesai
                                            @elseif ($pendaftaran->pn_status == 4)
                                                Ditolak
                                            @endif
                                        </td>
                                        <td>
    @if ($pendaftaran->pn_status == 3)
        <span>{{ $pendaftaran->pn_revisidosen }}</span>
    @endif
</td>


</tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            Data Kosong!
                                        </td>
                                    </tr>
                                    @endforelse

        </tbody>
    </table>

</body>
</html>
