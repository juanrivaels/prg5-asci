@extends('layouts.app')

@section('title', 'Menu Pendaftaran')

@section('contents')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Pendaftaran</h1>
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
                                    @if ($pendaftaran->pd_status != 7)
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
                                            @if ($pendaftaran->pd_status >= 3 && $pendaftaran->pd_status <= 7)
                                                <button class="btn btn-info show-competition-info" data-id="{{ $pendaftaran->id }}">Info Lomba</button>
                                            @endif

                                            @if ($pendaftaran->pd_status == 2)
                                                <button class="btn btn-info show-rejection-reason" data-id="{{ $pendaftaran->id }}">Alasan</button>
                                            @endif

                                        </td>

                        
                                    </tr>
                                    @endif

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

        <div class="modal fade" id="rejectionReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectionReasonModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectionReasonModalLabel">Alasan Penolakan</h5>
                    </div>
                    <div class="modal-body">
                        <p id="rejectionReasonText"></p>
                    </div>
                </div>
            </div>
        </div>

                <!-- Modal for Competition Info -->
        <div class="modal fade" id="competitionInfoModal" tabindex="-1" role="dialog" aria-labelledby="competitionInfoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="competitionInfoModalLabel">Info Lomba</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Display competition information here -->
                        <p>Lomba: {{ $pendaftaran->lomba->lb_judul ?? '' }}</p>
                        <p>Status Lomba: 
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
                        @else
                            Status Tidak Dikenal
                        @endif
                        </p>
                        <button class="btn btn-warning change-competition-status"
                            data-id="{{ $pendaftaran->id }}"
                            data-new-status="4"
                            @if ($pendaftaran->pd_status == 3)
                                style="display: block;"
                            @else
                                style="display: none;"
                            @endif
                            >Ganti Status Lomba ke Babak Penyisihan</button>

                        <button class="btn btn-warning change-competition-status"
                            data-id="{{ $pendaftaran->id }}"
                            data-new-status="5"
                            @if ($pendaftaran->pd_status == 4)
                                style="display: block;"
                            @else
                                style="display: none;"
                            @endif
                            >Ganti Status Lomba ke Babak Semifinal</button>

                        <button class="btn btn-warning change-competition-status"
                            data-id="{{ $pendaftaran->id }}"
                            data-new-status="6"
                            @if ($pendaftaran->pd_status == 5)
                                style="display: block;"
                            @else
                                style="display: none;"
                            @endif
                            >Ganti Status Lomba ke Babak Final</button>

                        <button class="btn btn-warning change-competition-status"
                            data-id="{{ $pendaftaran->id }}"
                            data-new-status="7"
                            @if ($pendaftaran->pd_status == 6)
                                style="display: block;"
                            @else
                                style="display: none;"
                            @endif
                            >Ganti Status Lomba ke Selesai</button>

                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Add this line to include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const showCompetitionInfoBtns = document.querySelectorAll('.show-competition-info');

    showCompetitionInfoBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const pendaftaranId = this.getAttribute('data-id');

            // Dapatkan informasi lomba sesuai ID, Anda perlu AJAX request atau sesuai kebutuhan Anda
            const competitionInfo = {
                lb_judul: "{{ $pendaftaran->lomba->lb_judul ?? '' }}",
                pd_status: "{{ $pendaftaran->pd_status ?? '' }}",
            };

            // Show the modal
            $('#competitionInfoModal').modal('show');
        });
    });

    const changeStatusBtns = document.querySelectorAll('.change-competition-status');

    changeStatusBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const pendaftaranId = this.getAttribute('data-id');
            const newStatus = this.getAttribute('data-new-status');

            Swal.fire({
                title: 'Yakin Ganti Status?',
                text: 'Perubahan status tidak bisa dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim AJAX request untuk mengganti status
                    $.ajax({
                        url: `/competition/change-status/${pendaftaranId}`,
                        method: 'POST',
                        data: { _token: "{{ csrf_token() }}", status: newStatus },
                        success: function (response) {
                            // Handle success, mungkin perlu me-refresh halaman atau mengupdate modal
                            location.reload();
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
    });
});

</script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showRejectionReasonBtns = document.querySelectorAll('.show-rejection-reason');

            showRejectionReasonBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const pendaftaranId = this.getAttribute('data-id');
                    const rejectionReason = "{{ $pendaftaran->pd_alasan ?? '' }}";

                    $('#rejectionReasonText').text(rejectionReason);
                    $('#rejectionReasonModal').modal('show');
                });
            });
        });
    </script>

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
