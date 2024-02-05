@extends('layouts.app')

@section('title', 'Menu Topik')

@section('contents')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Topik</h1>
            <nav>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title d-flex justify-content">
                                <a href="{{ route('topik.create') }}" class="btn btn-primary ">Tambah</a>
                            </h5>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <!-- Table with stripped rows -->
                            <table class="table table-striped compact-table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Topik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse($topik as $topik)
                                        @if($topik->tp_status == 1)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $topik->tp_nama }}</td>
                                                <td>
                                                    <a href="{{ route('topik.edit', ['id' => $topik->id]) }}" class="btn btn-warning">Ubah</a>
                                                    <a class="btn btm-sm btn-danger delete-btn" data-id="{{ $topik->id }}">Hapus</a>
                                                    <form id="delete-row-{{ $topik->id }}" action="{{ route('topik.destroy', ['id' => $topik->id]) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                Data Kosong!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

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
<script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"></script> <!-- Menambahkan skrip bahasa Indonesia -->

<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            language: {
                "decimal":        "",
                "emptyTable":     "Tidak ada data yang tersedia dalam tabel",
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered":   "(disaring dari _MAX_ total entri)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Tampilkan _MENU_ entri",
                "loadingRecords": "Memuat...",
                "processing":     "Sedang memproses...",
                "search":         "Cari:",
                "zeroRecords":    "Tidak ditemukan data yang sesuai",
                "paginate": {
                    "first":      "Pertama",
                    "last":       "Terakhir",
                    "next":       "Selanjutnya",
                    "previous":   "Sebelumnya"
                },
                "aria": {
                    "sortAscending":  ": aktifkan untuk mengurutkan kolom secara meningkat",
                    "sortDescending": ": aktifkan untuk mengurutkan kolom secara menurun"
                }
            }
        });
    });
</script>


<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
