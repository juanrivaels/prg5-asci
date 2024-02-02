@extends('layouts.app')

@section('title', 'Menu Lomba')

@section('contents')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Lomba</h1>
            <nav>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title d-flex justify-content">
                                <a href="{{ route('lomba.create') }}" class="btn btn-primary ">Tambah</a>
                            </h5>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <!-- Table with stripped rows -->
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Lomba</th>
                                        <th scope="col">Tanggal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Pelaksanaan</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col">Foto Lomba</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $i=1;
                                    @endphp

                                    @forelse($lombas->where('lb_status', 1) as $lomba)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $lomba->lb_judul }}</td>
                                        <td>{{ \Carbon\Carbon::parse($lomba->lb_tglmulai)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($lomba->lb_tglselesai)->format('Y-m-d') }}</td>
                                        <td>{{ $lomba->topik->tp_nama }}</td>
                                        <td>{{ $lomba->lb_lokasi }}</td>
                                        <td>
                                            <img src="{{ asset('sertifikat/' . $lomba->lb_gambar) }}" alt=""
                                                style="width: 40px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('lomba.edit', ['id' => $lomba->id]) }}"
                                                class="btn btn-warning ">Ubah</a>
                                            <a class="btn btm-sm btn-danger delete-btn"
                                                data-id="{{ $lomba->id }}">Hapus</a>
                                            <form id="delete-row-{{ $lomba->id }}"
                                                action="{{ route('lomba.destroy', ['id' => $lomba->id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="14">
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
                const lombaId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin Hapus Data?',
                    text: 'Data tidak akan bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`delete-row-${lombaId}`);
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
