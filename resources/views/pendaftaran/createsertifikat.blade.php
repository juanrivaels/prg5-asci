@extends('layouts.app')

@section('title','Daftar Sertifikat')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Input Sertifikat</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-title">
                        <h4>Whoops!</h4>
                    </div>
                    Terdapat kesalahan saat ingin menambahkan data
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

            <!-- Vertical Form -->
            <form action="{{ route('pendaftaran.storesertifikat') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="sf_idlomba" class="form-label">Lomba<span style="color: red">*</span></label>
                <select class="form-select" name="sf_idlomba" id="sf_idlomba" required>
                    <option value="">Pilih Lomba</option>
                    @foreach($pendaftarans as $p)
                        @if($p->pd_status == 7 && $p->pd_userid == session('user.id'))
                            <option value="{{ $p->pd_idlomba }}">{{ $p->lomba->lb_judul }}</option>

                        @endif
                    @endforeach
                </select>
            </div>
            
            <input for="sf_idpendaftaran" type="hidden" id="sf_idpendaftaran" name="sf_idpendaftaran" value="{{ $p->id }}">
            <input for="sf_userid" type="hidden" id="sf_userid" name="sf_userid" value="{{ session('user.id') }}">

                <div class="row">
                <div class="col-md-6">
                    <label for="sf_juara">Juara<span style="color: red">*</span></label>
                    <select id="sf_juara" name="sf_juara" class="form-select">
                        <option value="Juara 1">Juara 1</option>
                        <option value="Juara 2">Juara 2</option>
                        <option value="Juara 3">Juara 3</option>
                        <option value="Juara Umum">Juara Umum</option>
                        <option value="Juara Favorit">Juara Favorit</option>
                        <option value="Juara Harapan">Juara Harapan</option>
                        <option value="Partisipan">Partisipan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sf_evaluasi">Evaluasi Lomba</label>
                    <textarea class="form-control" name="sf_evaluasi" id="sf_evaluasi" rows="4"></textarea>
                </div>

                <div class="col-md-6">
                <input type="hidden" name="sf_tanggal" id="sf_tanggal" class="form-control" required readonly >
            </div>

            <!-- Tambahkan script JavaScript di sini -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                    var yyyy = today.getFullYear();

                    today = yyyy + '-' + mm + '-' + dd;
                    document.getElementById('sf_tanggal').value = today;
                });
            </script>
                </div>

                <div class="form-group">
                <label for="sf_sertifikat">Sertifikat<span style="color: red">*</span></label>
                <div class="input-group">
                    <div class="custom-file" style="width: 100%;">
                        <input type="file" class="form-control" name="sf_sertifikat" id="sf_sertifikat" style="width: 100%;">
                    </div>
                </div>
            </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection
