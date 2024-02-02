@extends('layouts.app')

@section('title','Tambah User')

@section('contents')

<!-- Main -->
<main id="main" class="main">
<img src="assets/img/ASCI.png" alt="">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Menu Tambah Pengguna</h5>
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
            <form action="{{ route('users.index') }}" method="post" enctype="multipart/form-data">
                @csrf

            <div class="form-group">
                <label for="us_nama">Nama Lengkap<span style="color: red">*</span></label>
                <input name="us_nama" id="us_nama" placeholder="Nama Lengkap" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="us_username">Nama Pengguna<span style="color: red">*</span></label>
                    <input name="us_username" id="us_username" placeholder="Contoh: NIM / Nama" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="us_password">Kata Sandi<span style="color: red">*</span></label>
                    <input name="us_password" type="password" id="us_password" placeholder="Minimal 3 Karakter" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="us_noinduk">NIDN/NIM<span style="color: red">*</span></label>
                    <input type="number" name="us_noinduk" id="us_noinduk" placeholder="NIDN/NIM" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="us_role">Role<span style="color: red">*</span></label>
                    <select id="us_role" name="us_role" class="form-select">
                        <option value="Admin">Admin</option>
                        <option value="Dosen">Dosen Pembimbing</option>
                        <option value="Himma">Himma</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="us_email">E-mail<span style="color: red">*</span></label>
                    <input type="email" name="us_email" id="us_email" class="form-control" placeholder="Contoh: emailaddress@gmail.com" required>
                    <script th:inline="javascript">
                                    /* JavaScript to validate email format */
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const emailInput = document.getElementById('email');
                                        const emailFormatError = document.getElementById('email-format-error');
                                        const emailEmptyError = document.getElementById('email-empty-error');

                                        emailInput.addEventListener('input', function() {
                                            const isValid = emailInput.checkValidity();
                                            if (isValid) {
                                                emailFormatError.style.display = 'none';
                                                emailEmptyError.style.display = 'none';
                                            } else {
                                                if (emailInput.value.length > 0) { 
                                                    emailFormatError.style.display = 'block';
                                                    emailEmptyError.style.display = 'none';
                                                } else {
                                                    emailFormatError.style.display = 'none';
                                                    emailEmptyError.style.display = 'block'; // Show the error when the input is empty
                                                }
                                            }
                                        });

                                        // Initially check and display error if email is invalid or empty on page load
                                        if (!emailInput.checkValidity()) {
                                            if (emailInput.value.length > 0) {
                                                emailFormatError.style.display = 'block';
                                                emailEmptyError.style.display = 'none';
                                            } else {
                                                emailEmptyError.style.display = 'block';
                                            }
                                        }
                                    });
                     </script>
                </div>

                <div class="col-md-6">
                    <label for="us_telepon">Nomor Telepon<span style="color: red">*</span></label>
                    <input type="number" name="us_telepon" id="us_telepon" placeholder="Contoh: 08XXXXXXXXXX" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="us_pasfoto">Foto Profil</label>
                <div class="input-group">
                    <div class="custom-file" style="width: 100%;">
                        <input type="file" class="form-control" name="us_pasfoto" id="us_pasfoto" style="width: 100%;">
                    </div>
                    <small style="color: red">Catatan:</small> <small>Maksimal ukuran gambar 1MB!.</small>
                </div>
            </div>

            <input type="hidden" name="us_status" value="1">


            <button type="submit" class="btn btn-primary">Kirim</button>
            <button type="reset" class="btn btn-danger">Atur Ulang</button>
 
            </form>
        </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection