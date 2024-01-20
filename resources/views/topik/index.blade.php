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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Topik</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $i=1;
                                    @endphp

                                    @forelse($topik as $topik)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $topik->tp_nama }}</td>
                                        <td>
                                        @if ($topik->tp_status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('topik.edit', ['id' => $topik->id]) }}"
                                                class="btn btn-warning ">Edit</a>
                                            <a class="btn btm-sm btn-danger delete-btn"
                                                data-id="{{ $topik->id }}">Delete</a>
                                            <form id="delete-row-{{ $topik->id }}"
                                                action="{{ route('topik.destroy', ['id' => $topik->id]) }}"
                                                method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            No Record Found!
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
                    confirmButtonText: 'Yes!'
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
    });
</script>

<!-- ... (bagian lain dari kode HTML Anda) ... -->
@endsection
