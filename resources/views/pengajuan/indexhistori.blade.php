@extends('layouts.app')

@section('title', 'Menu Pengajuan Bimbingan')

@section('contents')
    <main id="main" class="main">

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
                                        <th scope="col">Hasil Revisi</th>
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
                                        <td>{{ \Carbon\Carbon::parse($pendaftaran->pd_tglpengajuan)->format('Y-m-d') }}</td> 
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
                                                <button class="btn btn-info view-revision" data-toggle="modal" data-target="#revisionModal" data-revision="{{ $pendaftaran->pn_revisidosen }}">
                                                    Lihat Revisi
                                                </button>
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

    </main><!-- End #main -->

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
