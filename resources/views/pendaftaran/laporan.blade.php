@extends('layouts.app')

@section('title', 'Data Laporan')

@section('contents')
<head>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

    <main id="main" class="main">


    <div class="d-flex justify-content-end">
        <form id="pdfForm" action="{{ route('pendaftaran.cetak-pdf') }}" method="GET" target="_blank">

            <!-- Input untuk menyimpan tanggal yang dipilih -->
            <input type="hidden" id="sort_start_date" name="sort_start_date" value="{{ request('tanggal_mulai') }}">
            <input type="hidden" id="sort_end_date" name="sort_end_date" value="{{ request('tanggal_selesai') }}">

            <!-- Input untuk memilih rentang tanggal untuk pengurutan -->
            <input type="date" id="tglawal" name="tglawal" value="{{ request('tanggal_mulai') }}">
            <input type="date" id="tglakhir" name="tglakhir" value="{{ request('tanggal_selesai') }}">

            <input type="hidden" name="preview" value="1">

            <button type="button" onclick="prepareAndSubmit()" class="btn btn-primary">
                Cetak Laporan PDF <i class="fas fa-print"></i>
            </button>
        </form>
    </div>



    User
        <div class="pagetitle">
            <h1>Data Laporan</h1>
            <nav>
            </nav>
        </div><!-- End Page Title -->



        <section class="section">
            <div class="row">
                <div class="col-lg-12">


                    <!-- Data Pendaftaran -->
                    <div class="card">
                        <div class="card-body">
                            <!-- Table with stripped rows for Pendaftaran -->
                            <table class="table table-striped" id="pendaftaranTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Pelaksanaan</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                    @endphp
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
                                        <td colspan="6">
                                            Data Kosong!
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>    
                            </table>

                            <!-- End Table with stripped rows for Pendaftaran -->
                            <!-- Link untuk Membuat Laporan PDF -->

                        </div>
                            <!-- End Table with stripped rows for Pendaftaran -->
                        </div>
                    </div>
                    <!-- End Data Pendaftaran -->

                </div>
            </div>
        </section>

        <div id="preview-container"></div>
        
    </main><!-- End #main -->

    <script>
        function prepareAndSubmit() {
            // Ambil nilai tanggal dari elemen input
            var tglAwal = document.getElementById('tglawal').value;
            var tglAkhir = document.getElementById('tglakhir').value;

            // Set nilai pada elemen input tersembunyi
            document.getElementById('tanggal').value = tglAwal;
            document.getElementById('tanggal').value = tglAkhir;

            // Submit formulir
            document.getElementById('pdfForm').submit();
        }
    </script>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menggunakan JavaScript untuk mengambil preview saat halaman dimuat
            fetch("{{ route('pendaftaran.cetak-pdf', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai'), 'preview' => 1]) }}")
                .then(response => response.blob())
                .then(blob => {
                    // Membuat URL objek untuk blob
                    const url = URL.createObjectURL(blob);

                    // Menampilkan PDF di halaman
                    const embed = document.createElement("embed");
                    embed.src = url;
                    embed.width = "100%";
                    embed.height = "600px";

                    // Menambahkan elemen embed ke elemen HTML yang diinginkan
                    document.getElementById("preview-container").appendChild(embed);
                });
        });
    </script> -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteLinks = document.querySelectorAll('a.delete-btn');

            deleteLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const userId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Yakin Hapus Data?',
                        text: 'Data tidak akan bisa dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById(`delete-row-${userId}`);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            // Add DataTable initialization for the pendaftaranTable
            $('#pendaftaranTable').DataTable();
        });
    </script>
    <script>
        function prepareAndSubmit() {
            // Ambil nilai tanggal dari elemen input
            var tglAwal = document.getElementById('tglawal').value;
            var tglAkhir = document.getElementById('tglakhir').value;

            // Set nilai pada elemen input tersembunyi
            document.getElementById('sort_start_date').value = tglAwal;
            document.getElementById('sort_end_date').value = tglAkhir;

            // Submit formulir
            document.getElementById('pdfForm').submit();
        }
    </script>
    <!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
