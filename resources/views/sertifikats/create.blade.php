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

            <!-- Vertical Form -->
            <form action="{{ route('sertifikats.index') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="pd_idlomba" class="form-label">Lomba<span style="color: red">*</span></label>
                <select class="form-select" name="pd_idlomba" id="pd_idlomba" required>
                    <option value="">Pilih Lomba</option>
                    @foreach($pendaftarans as $p)
                        @if($p->pd_status == 7 && $p->pd_userid == session('user.id'))
                            <option value="{{ $p->id }}">{{ $p->lomba->lb_judul }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

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
                    </select>
                </div>

                    <div class="col-md-6">
                        <label for="sf_tanggal">Tanggal Input Sertifikat<span style="color: red">*</span></label>
                        <input type="date" name="sf_tanggal" id="sf_tanggal" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                <label for="sf_sertifikat">Sertifikat<span style="color: red">*</span></label>
                <div class="input-group">
                    <div class="custom-file" style="width: 100%;">
                        <input type="file" class="form-control" name="sf_sertifikat" id="sf_sertifikat" style="width: 100%;">
                    </div>
                </div>
            </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection
