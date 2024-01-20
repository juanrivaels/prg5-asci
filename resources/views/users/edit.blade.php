@extends('layouts.app')

@section('title', 'Update User')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Update User</h5>

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
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Vertical Form -->
            <form action="{{ route('users.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                <label for="us_nama">Nama Lengkap<span style="color: red">*</span></label>
                <input name="us_nama" id="us_nama" placeholder="Nama Lengkap" class="form-control" value="{{ $user->us_nama }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="us_username">Username<span style="color: red">*</span></label>
                        <input name="us_username" id="us_username" placeholder="e.g: NIM / Nama" class="form-control" value="{{ $user->us_username }}" required readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="us_password">Password<span style="color: red">*</span></label>
                        <input name="us_password" type="password" id="us_password" placeholder="e.g: 8 Characters" 
                        value="{{ $user->us_password }}" class="form-control">
                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="us_noinduk">NIDN/NIM<span style="color: red">*</span></label>
                        <input name="us_noinduk" id="us_noinduk" placeholder="NIDN/NIM" class="form-control" value="{{ $user->us_noinduk }}" required readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="us_role">Role<span style="color: red">*</span></label>
                        <select id="us_role" name="us_role" class="form-select">
                            <option value="Admin" {{ $user->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Dosen" {{ $user->role === 'Dosen Pembimbing' ? 'selected' : '' }}>Dosen Pembimbing</option>
                            <option value="Himma" {{ $user->role === 'Himma' ? 'selected' : '' }}>Himma</option>
                            <option value="Mahasiswa" {{ $user->role === 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="us_email">E-mail<span style="color: red">*</span></label>
                        <input type="email" name="us_email" id="us_email" class="form-control" placeholder="e.g: emailaddress@gmail.com" value="{{ $user->us_email }}" required>
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
                                                emailEmptyError.style.display = 'none'; // Hide empty email error if format is valid
                                            } else {
                                                if (emailInput.value.length > 0) { // Check if the input is not empty
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
                        <input type="number" name="us_telepon" id="us_telepon" placeholder="e.g: 08XXXXXXXXXX" class="form-control" value="{{ $user->us_telepon }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="us_pasfoto">Foto Profile<span style="color: red">*</span></label>
                    <div class="input-group">
                        <div class="custom-file" style="width: 100%;">
                            <input type="file" class="form-control" name="us_pasfoto" id="us_pasfoto" style="width: 100%;">
                        </div>
                        <small style="color: red">Note:</small> <small>Maksimal ukuran gambar 10MB!.</small>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</main>
<!-- End - Main -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@endsection
