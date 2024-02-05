@extends('layouts.app')

@section('title','Portofolio')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Portofolio</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-title">
                        <h4>Whoops!</h4>
                    </div>
                    Terdapat kesalahan saat ingin menambahkan data!
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
            <form action="{{ route('pengajuan.storeporto') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="pfo_idtopik" class="form-label">Topik<span style="color: red">*</span></label>
                <select class="form-select" name="pfo_idtopik" id="pfo_idtopik" required>
                    <option value="">Pilih Topik</option>
                    @foreach($topiks as $t)
                    @if($t->tp_status == 1)
                        <option value="{{ $t->id }}">{{ $t->tp_nama }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <input for="pfo_iduser" type="hidden" id="pfo_iduser" name="pfo_iduser" value="{{ session('user.id') }}">

                <div class="form-group">
                <label for="pfo_file">Sertifikat<span style="color: red">*</span></label>
                <div class="input-group">
                    <div class="custom-file" style="width: 100%;">
                        <input type="file" class="form-control" name="pfo_file" id="pfo_file" style="width: 100%;">
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
