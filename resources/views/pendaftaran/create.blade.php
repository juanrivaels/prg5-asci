@extends('layouts.app')

@section('title','Daftar Lomba')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Pendaftaran Lomba</h5>
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
            <form action="{{ route('pendaftaran.index') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pd_idlomba" class="form-label">Lomba<span style="color: red">*</span></label>
                            <select class="form-select" name="pd_idlomba" id="pd_idlomba" required>
                                <option value="">Pilih Lomba</option>
                                @foreach($lombas as $lomba)
                                    <option value="{{ $lomba->id }}" @if($lomba->id == request('selectedCompetition')) selected @endif>{{ $lomba->lb_judul }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pd_iddosen" class="form-label">Dosen Pembimbing<span style="color: red">*</span></label>
                        <select class="form-select" name="pd_iddosen" id="pd_iddosen" required>
                            <option value="">Pilih Dosen Pembimbing</option>
                            @foreach($users as $user)
                                @if($user->us_role == 'Dosen')
                                    <option value="{{ $user->id }}">{{ $user->us_nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <input for="pd_userid" type="hidden" id="pd_userid" name="pd_userid" value="{{ session('user.id') }}">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pd_namamahasiswa" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="pd_namamahasiswa" name="pd_namamahasiswa" value="{{ session('user.name') }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pd_tgldaftar">Tanggal Daftar<span style="color: red">*</span></label>
                        <input type="datetime-local" name="pd_tgldaftar" id="pd_tgldaftar" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="pd_tglpengajuan">Tanggal Pengajuan<span style="color: red">*</span></label>
                        <input type="datetime-local" name="pd_tglpengajuan" id="pd_tglpengajuan" class="form-control" required>
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
k