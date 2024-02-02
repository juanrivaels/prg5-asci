@extends('layouts.app')

@section('title', 'Menu Pendaftaran')

@section('contents')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Pendaftaran Lomba</h1>
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
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Status Lomba</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                    @endphp
                                    @forelse($pendaftarans as $pendaftaran)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pendaftaran->lomba->lb_judul }}</td>
                                        <td>{{ $pendaftaran->user->us_nama }}</td>
                                        <td>{{ $pendaftaran->dosen->us_nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pendaftaran->pd_tgldaftar)->format('Y-m-d') }}</td>   
                                        <td>
                                            @if ($pendaftaran->pd_status == 1)
                                                Menunggu Konfirmasi
                                            @elseif ($pendaftaran->pd_status == 2)                                        
                                                Ditolak
                                            @elseif ($pendaftaran->pd_status == 3)
                                                Diterima
                                            @elseif ($pendaftaran->pd_status == 4)
                                                Babak Penyisihan
                                            @elseif ($pendaftaran->pd_status == 5)
                                                Babak Semifinal
                                            @elseif ($pendaftaran->pd_status == 6)
                                                Babak Final
                                            @elseif ($pendaftaran->pd_status == 7)
                                                Selesai   
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-success accept-btn" data-id="{{ $pendaftaran->id }}">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                            <form id="accept-row-{{ $pendaftaran->id }}" action="{{ route('pendaftaran.editdosen', ['id' => $pendaftaran->id]) }}" method="POST">
                                                <input type="hidden" name="_method" value="GET">
                                                @csrf
                                            </form>

                                            <a class="btn btn-sm btn-danger delete-btn reject-btn" data-id="{{ $pendaftaran->id }}">
                                                <i class="bi bi-x-lg"></i>
                                            </a>
                                            <form id="delete-row-{{ $pendaftaran->id }}" action="{{ route('pendaftaran.destroylomba', ['id' => $pendaftaran->id]) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
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

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const acceptBtns = document.querySelectorAll('.accept-btn');

        acceptBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const pendaftaranId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin Terima Lomba?',
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
                    confirmButtonText: 'Tolak Lomba'
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
