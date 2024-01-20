@extends('layouts.app')

@section('title', 'Data Sertifikat')

@section('contents')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Sertifikat</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <h5 class="card-title d-flex justify-content">
                                <a href="{{ route('sertifikat.create') }}" class="btn btn-primary ">Tambah</a>
                            </h5>
                        <div class="card-body">
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
                                        <th scope="col">Nama Lomba</th>
                                        <th scope="col">Juara</th>
                                        <th scope="col">Tanggal Input</th>
                                        <!-- <th scope="col">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp

                                    @forelse($sertifikats as $sertifikat)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $sertifikat->pendaftaran->lomba->lb_judul }}</td>
                                            <td>{{ $sertifikat->sf_juara }}</td>
                                            <td>{{ $sertifikat->sf_tanggal }}</td>
                                            <!-- <td>
                                                <a href="{{ route('sertifikat.edit', ['id' => $sertifikat->id]) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a class="btn btn-sm btn-danger delete-btn"
                                                    data-id="{{ $sertifikat->id }}">Delete</a>
                                                <form id="delete-row-{{ $sertifikat->id }}"
                                                    action="{{ route('sertifikat.destroy', ['id' => $sertifikat->id]) }}"
                                                    method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    @csrf
                                                </form>
                                            </td> -->
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
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
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteLinks = document.querySelectorAll('a.delete-btn');

            deleteLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const sertifikatId = this.getAttribute('data-id');

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
                            const form = document.getElementById(`delete-row-${sertifikatId}`);
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
@endsection
