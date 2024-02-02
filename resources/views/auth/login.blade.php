<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/ASCI Web.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        .logo-container {
            margin-left: auto; 
            margin-right: 15px; 
}
    </style>

</head>

<body>
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('auth.login') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/ASCI.png') }}" alt="">
                <span class="d-none d-lg-block">ASCI</span>
            </div>
            <div class="logo-container d-flex align-items-center justify-content-end">
                <img src="{{ asset('assets/img/AstraTech.png') }}" alt="">
            </a>
        </div><!-- End Logo -->
    </header><!-- End Header -->

    <body
        style="background-image: url('{{ asset('assets/img/IMG_Background.jpg') }}'); display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-4 offset-7">
                    <div class="card">
                            @if(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                            @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">Selamat Datang, Pengguna!</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{ route('auth.action') }}">
                                <div class="col-12">
                                    <label for="Username" class="form-label">Nama Akun <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="Username" name="Username">
                                </div>
                                <div class="col-12">
                                    <label for="Password" class="form-label">Kata Sandi <span style="color:red">*</span></label>
                                    <input type="password" class="form-control" id="Password" name="Password">
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                </div>
                            </form><!-- Vertical Form -->



                        </div>
                    </div>
                </div>
                <!-- Tambahkan div untuk elemen di sebelah kanan -->
                <div class="col-lg-6">
                    <!-- Isi dengan elemen yang diinginkan -->
                </div>
            </div>
        </div>

        <!-- ======= Footer ======= -->
        <div class="mt-5" style="background-color: white; width: 100%; position: fixed; left: 0; bottom: 0;">
        <div class="container-fluid">
            <footer class="d-flex flex-wrap pt-3 pb-3 border-top">
                Hak Cipta &copy; @php echo date('Y') @endphp - Kelompok 06 2D Politeknik Astra 
            </footer>
        </div>
    </div>
    </body>


</html>