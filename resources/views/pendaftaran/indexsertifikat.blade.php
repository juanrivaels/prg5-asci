@extends('layouts.app')

@section('title', 'Data Sertifikat')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Sertifikat</h5>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Table for displaying certificates -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">Lomba</th>
                        <th scope="col">Juara</th>
                        <th scope="col">Tanggal Input</th>
                        <th scope="col">Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sertifikats as $index => $certificate)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $certificate->user->us_nama }}</td>
                            <td>{{ $certificate->lomba->lb_judul }}</td>
                            <td>{{ $certificate->sf_juara }}</td>
                            <td>{{ $certificate->sf_tanggal }}</td>
                            <td>
                            <form action="{{ route('pendaftaran.downloadFile', ['file' => $certificate->sf_sertifikat]) }}" method="GET">
                                <button class="btn btn-sm btn-success" type="submit">Download</button>
                            </form>
                             </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Tidak ada sertifikat!.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- End - Table for displaying certificates -->
        </div>
    </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection
