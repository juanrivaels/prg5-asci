@extends('layouts.app')

@section('title', 'Update Pengajuan Lomba')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Update Pengajuan Bimbingan</h5>
            @if ($errors->any())
                <!-- Display validation errors -->
                <div class="alert alert-danger">
                    <div class="alert-title">
                        <h4>Whoops!</h4>
                    </div>
                    There are some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-success">{{ session('error') }}</div>
            @endif

            <!-- Update Form -->
            <form action="{{ route('pendaftaran.storepengajuan', $existingPengajuan->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use the PUT method for updates -->

                <!-- Existing data fields -->
                <input type="hidden" id="pd_userid" name="pd_userid" value="{{ $existingPengajuan->pd_userid }}">
                <input type="hidden" id="pd_idlomba" name="pd_idlomba" value="{{ $existingPengajuan->pd_idlomba }}">

                <!-- Add or modify other fields as needed -->

                <div class="row">
                    <div class="col-md-6">
                        <label for="pd_idlomba" class="form-label">Lomba<span style="color: red">*</span></label>
                        <select class="form-select" name="pd_idlomba" id="pd_idlomba" required>
                            <!-- Populate the dropdown with available options -->
                            @foreach($pendaftarans as $p)
                                @if($p->pd_status == 3 && $p->pd_userid == session('user.id'))
                                    <option value="{{ $p->pd_idlomba }}"
                                        {{ $p->pd_idlomba == $existingPengajuan->pd_idlomba ? 'selected' : '' }}>
                                        {{ $p->lomba->lb_judul }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pd_iddosen" class="form-label">Dosen Pembimbing<span style="color: red">*</span></label>
                        <select class="form-select" name="pd_iddosen" id="pd_iddosen" required>
                            <!-- Populate the dropdown with available options -->
                            @foreach($users as $user)
                                @if($user->us_role == 'Dosen')
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $existingPengajuan->pd_iddosen ? 'selected' : '' }}>
                                        {{ $user->us_nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pd_tglpengajuan">Tanggal Pengajuan<span style="color: red">*</span></label>
                        <input type="date" name="pd_tglpengajuan" id="pd_tglpengajuan"
                            class="form-control" required
                            value="{{ $existingPengajuan->pd_tglpengajuan }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</main>
<!-- End - Main -->

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {
        // Menangani perubahan pilihan pada select lomba
        $('#pd_idlomba').change(function () {
            var selectedLombaId = $(this).val();
            
            // Mengirim permintaan AJAX untuk mendapatkan informasi pendaftaran
            $.ajax({
                url: '/get-dosen-by-lomba/' + selectedLombaId, // Gantilah URL sesuai dengan rute atau endpoint Anda
                type: 'GET',
                success: function (data) {
                    // Memperbarui select nama dosen dengan data yang diterima dari server
                    $('#pd_iddosen').empty(); // Mengosongkan opsi yang ada
                    $.each(data, function (key, value) {
                        $('#pd_iddosen').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function () {
                    console.log('Error fetching data.');
                }
            });
        });
    });
</script>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection
k