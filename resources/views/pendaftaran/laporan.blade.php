@extends('layouts.app')

@section('title', 'Data Laporan')

@section('contents')
<main id="main" class="main">
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
                                    <th scope="col">Judul Lomba</th>
                                    <th scope="col">Pelaksanaan</th>
                                    <th scope="col">Penyelenggara</th>
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
                                    <td>{{ $pendaftaran->lomba->lb_penyelenggara }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pendaftaran->lomba->lb_tglselesai)->format('Y-m-d') }}
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

    <!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
