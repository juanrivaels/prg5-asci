@extends('layouts.app')

@section('title','Tambah Topik')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Tambah Topik</h5>
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
            <form action="{{ route('topik.index') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="tp_nama">Nama Topik<span style="color: red">*</span></label>
                    <input name="tp_nama" id="tp_nama" placeholder="Nama Topik" class="form-control" required>
                </div>


            <input type="hidden" name="tp_status" value="1">

            <button type="submit" class="btn btn-primary">Kirim</button>
            <button type="reset" class="btn btn-danger">Atur Ulang</button>
 
            </form>
        </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

        <!-- Di dalam bagian head -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Memeriksa apakah ada data yang tersimpan di localStorage
        if (localStorage.formData) {
            // Mengambil data dari localStorage dan mengisi kembali field-form
            const formData = JSON.parse(localStorage.formData);
            Object.keys(formData).forEach(function (key) {
                const element = document.getElementById(key);
                if (element) {
                    element.value = formData[key];
                }
            });
        }

        // Menyimpan data ke localStorage setiap kali input berubah
        document.querySelectorAll('input, select, textarea').forEach(function (element) {
            element.addEventListener('input', function () {
                saveFormData();
            });
        });

        // Fungsi untuk menyimpan data ke localStorage
        function saveFormData() {
            const formData = {};
            document.querySelectorAll('input, select, textarea').forEach(function (element) {
                formData[element.id] = element.value;
            });
            localStorage.formData = JSON.stringify(formData);
        }
    });
</script>


@endsection