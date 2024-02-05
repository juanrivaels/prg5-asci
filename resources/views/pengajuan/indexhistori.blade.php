@extends('layouts.app')

@section('title', 'Menu Pengajuan Bimbingan')

@section('contents')

<head>
    <!-- Font Awesome CSS -->
<!-- Tambahkan ini di bagian head HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />

</head>

    <main id="main" class="main">

    <!-- HTML -->
<div class="d-flex justify-content-end">
    <form id="pdfForm" action="{{ route('pengajuan.cetak-pdf2') }}" method="GET" target="_blank">
        <input type="hidden" id="sort_start_date" name="sort_start_date" value="{{ request('tanggal_mulai') }}">
        <input type="hidden" id="sort_end_date" name="sort_end_date" value="{{ request('tanggal_selesai') }}">
        <input type="date" id="tglawal" name="tglawal" value="{{ request('tanggal_mulai') }}">
        <input type="date" id="tglakhir" name="tglakhir" value="{{ request('tanggal_selesai') }}">
        <input type="hidden" name="preview" value="1">
        <button type="button" onclick="prepareAndSubmit2()" class="btn btn-primary">
            Cetak Laporan PDF <i class="fas fa-print"></i>
        </button>
    </form>
</div>

<!-- JavaScript -->
<script>
    function prepareAndSubmit2() {
        var tglAwal = document.getElementById('tglawal').value;
        var tglAkhir = document.getElementById('tglakhir').value;
        document.getElementById('sort_start_date').value = tglAwal;
        document.getElementById('sort_end_date').value = tglAkhir;
        document.getElementById('pdfForm').submit();

        // Menambahkan konfigurasi untuk HTML2PDF
        var pdfOptions = {
            margin: 15,
            filename: 'Laporan_Pengajuan.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }  // Konfigurasi untuk orientasi landscape
        };

        html2pdf(document.body, pdfOptions);

        // Hentikan submit form agar tidak terjadi reload halaman
        return false;
    }
</script>


        <div class="pagetitle">
            <h1>Data Pengajuan Bimbingan</h1>
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
                                        <th scope="col">Nama Lomba</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Dosen Pembimbing</th>
                                        <th scope="col">Tanggal Pengajuan</th>
                                        <th scope="col">Alasan</th>
                                        <th scope="col">Status Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                    @endphp
                                    @forelse($pengajuans as $pendaftaran )
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pendaftaran->lomba->lb_judul }}</td>
                                        <td>{{ $pendaftaran->user->us_nama }}</td>
                                        <td>{{ $pendaftaran->dosen->us_nama }}</td>
                                        <td>{{ $pendaftaran->pn_tglpengajuan }}</td>
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
                        </div>
                    </div>
                    <!-- End Data Pendaftaran -->

                </div>
            </div>
        </section>

        <div id="preview-container"></div>

    </main><!-- End #main -->

    <script>
        //     document.addEventListener("DOMContentLoaded", function() {
        //     // Menggunakan JavaScript untuk mengambil preview saat halaman dimuat
        //     fetch("{{ route('pengajuan.cetak-pdf2', ['tanggal_mulai' => request('tanggal_mulai'), 'tanggal_selesai' => request('tanggal_selesai'), 'preview' => 1]) }}")
        //         .then(response => response.blob())
        //         .then(blob => {
        //             // Membuat URL objek untuk blob
        //             const url = URL.createObjectURL(blob);

        //             // Menampilkan PDF di halaman
        //             const embed = document.createElement("embed");
        //             embed.src = url;
        //             embed.width = "100%";
        //             embed.height = "600px";

        //             // Menambahkan elemen embed ke elemen HTML yang diinginkan
        //             document.getElementById("preview-container").appendChild(embed);
        //         });
        // });

    </script>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Modal -->
<div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-labelledby="revisionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revisionModalLabel">Hasil Revisi Dosen</h5>
            </div>
            <div class="modal-body">
                <p id="revisionContent"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewRevisionBtns = document.querySelectorAll('.view-revision');

        viewRevisionBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const revisionContent = this.getAttribute('data-revision');
                document.getElementById('revisionContent').innerText = revisionContent;
                $('#revisionModal').modal('show');  // Tambahkan ini untuk memunculkan modal
            });
        });
    });
</script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const acceptBtns = document.querySelectorAll('.accept-btn');

        acceptBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const pendaftaranId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin Terima Pengajuan?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // You can perform additional actions here before submitting the form
                        const form = document.getElementById(`accept-row-${pendaftaranId}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rejectBtns = document.querySelectorAll('.reject-btn');

        rejectBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const pendaftaranId = this.getAttribute('data-id');

                // Create a textarea for entering the rejection reason
                Swal.fire({
                    title: 'Masukkan Alasan Penolakan',
                    input: 'textarea',
                    inputPlaceholder: 'Tuliskan alasan penolakan di sini...',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Tolak Pengajuan'
                }).then((result) => {
                    if (result.isConfirmed && result.value.trim() !== '') {
                        // You can perform additional actions here before submitting the form
                        const form = document.getElementById(`delete-row-${pendaftaranId}`);
                        const reasonInput = document.createElement('input');
                        reasonInput.type = 'hidden';
                        reasonInput.name = 'pd_alasan';
                        reasonInput.value = result.value.trim();
                        form.appendChild(reasonInput);
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

    <!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
