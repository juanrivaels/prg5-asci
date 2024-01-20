@extends('layouts.app')

@section('title', 'Menu Mahasiswa')

@section('contents')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Mahasiswa</h1>
            <nav>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title d-flex justify-content">

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
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nomor Induk</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Pas Foto</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $i=1;
                                    @endphp

                                    @forelse($users as $user)
                                        @if ($user->us_role == 'Mahasiswa')
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $user->us_nama }}</td>
                                                <td>{{ $user->us_noinduk }}</td>
                                                <td>{{ $user->us_role }}</td>
                                                <td>{{ $user->us_email }}</td>
                                                <td>{{ $user->us_telepon }}</td>
                                                <td>{{ $user->us_username }}</td>
                                                <td>
                                                    <img src="{{ asset('pasfoto/'.$user->us_pasfoto) }}" alt="" style="width: 40px;">
                                                </td>
                                                <td>
                                                    @if ($user->us_status == 1)
                                                        Aktif
                                                    @else
                                                        Tidak Aktif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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
