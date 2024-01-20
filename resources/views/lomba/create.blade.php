@extends('layouts.app')

@section('title','Tambah Lomba')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Lomba</h5>
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
            <form action="{{ route('lomba.index') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="form-group">
                <label for="lb_judul">Judul Lomba<span style="color: red">*</span></label>
                <input name="lb_judul" id="lb_judul" placeholder="Masukkan Judul Lomba" class="form-control" required>
            </div>
            <br>

        <div class="row">
            <div class="col-md-6">
                <label for="lb_tglmulai">Tanggal Mulai<span style="color: red">*</span></label>
                <input type="datetime-local" name="lb_tglmulai" id="lb_tglmulai" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="lb_tglselesai">Tanggal Selesai<span style="color: red">*</span></label>
                <input type="datetime-local" name="lb_tglselesai" id="lb_tglselesai" class="form-control" required>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-6">
                <label>Kategori<span style="color: red">*</span></label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lb_kategori" id="lb_kategori0" value="0" required>
                    <label class="form-check-label" for="lb_kategori">Akademik</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="lb_kategori" id="lb_kategori1" value="1" required>
                    <label class="form-check-label" for="lb_kategori">Non Akademik</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="topik" class="form-label">Topik<span style="color: red">*</span></label>
                    <select class="form-select" name="lb_idtopik" id="lb_idtopik" required>
                        <option value="">Pilih Topik</option>
                        @foreach($topiks as $topik)
                            <option value="{{ $topik->id }}">{{ $topik->tp_nama }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
             </div>
            <br>

        <div class="row">
            <div class="col-md-6">
                <label for="lb_jenis">Jenis<span style="color: red">*</span></label>
                <select id="lb_jenis" class="form-select" name="lb_jenis" required>
                    <option value="0">Individu</option>
                    <option value="1">Kelompok</option>
                    <option value="2">Individu dan Kelompok</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="lb_tingkat">Tingkatan<span style="color: red">*</span></label>
                <select id="lb_tingkat" class="form-select" name="lb_tingkat" required>
                    <option value="0">Internal Kampus</option>
                    <option value="1">Regional</option>
                    <option value="2">Nasional</option>
                    <option value="3">Internasional</option>
                </select>
            </div>
        </div>
        <br>

        <div class="form-group">
            <label for="lb_penyelenggara">Penyelenggara<span style="color: red">*</span></label>
            <input name="lb_penyelenggara" id="lb_penyelenggara" placeholder="Masukkan Penyelenggara" class="form-control" required>
        </div>
        <br>

    
        <div class="col-md-6">
            <label>Pelaksanaan<span style="color: red">*</span></label><br>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lb_pelaksanaan" id="lb_pelaksanaan0" value="0" required>
                <label class="form-check-label" for="lb_pelaksanaan">Offline</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lb_pelaksanaan" id="lb_pelaksanaan1" value="1" required>
                <label class="form-check-label" for="lb_pelaksanaan">Online</label>
            </div>
            </div>

            <div class="form-group">
            <label for="lb_lokasi">Lokasi<span style="color: red">*</span></label>
            <input name="lb_lokasi" id="lb_lokasi" placeholder="Masukkan Lokasi" class="form-control" required>
            <small style="color: red">Note:</small> <small>Jika dilaksanakan secara offline, tuliskan nama lokasi pelaksaan lombanya.</small>
            </div>

            <div class="form-group">
            <label for="lb_deskripsi">Deskripsi<span style="color: red">*</span></label>
            <input name="lb_deskripsi" id="lb_deskripsi" placeholder="Masukkan Deskripsi" class="form-control" required>
            </div>
        <br>

        <div class="form-group">
            <label for="lb_gambar">Foto Lomba<span style="color: red">*</span></label>
            <div class="input-group">
                <div class="custom-file" style="width: 100%;">
                    <input type="file" class="form-control" name="lb_gambar" id="lb_gambar" style="width: 100%;">
                </div>
                <small style="color: red">Note:</small> <small>Maksimal ukuran gambar 10MB!.</small>
            </div>
        </div>
        <br>
        <br>
            
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
        <a href="{{ route('topik.index') }}" class="btn btn-secondary">Cancel</a>
 
    </form>
        </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection