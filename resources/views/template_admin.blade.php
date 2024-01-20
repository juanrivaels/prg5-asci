
   <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        
    
        <div class="d-flex align-items-center justify-content-between">
        <a class="logo d-flex align-items-center">
        <img src="assets/img/ASCI.png" alt="">
        <span class="d-none d-lg-block">ASCI</span>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        </a>
       
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                <?php
                $username = session('user.name') ?? 'Guest';
                $pasfoto = session('user.us_pasfoto') ?? 'Guest';
                $pasfotoPath = asset('pasfoto/' . $pasfoto);
                ?>
                <img src="<?php echo $pasfotoPath; ?>" alt="Profile" class="rounded-circle" width="40" height="40" style="margin-right: 10px;" >
                <span>Hai, <b><?php echo $username; ?></b></span>
                </li>
            </ul>
        </nav>
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="bi bi-house"></i> 
            <span>Dashboard</span>
        </a>
    </li>

    @if(session('user.role') == 'Admin' || session('user.role') == 'Himma' || session('user.role') == 'Dosen')
    <li class="nav-heading">Halaman Master</li>
    @endif

            <!-- User Page Nav (only visible for "Admin") -->
            @if(session('user.role') == 'Admin' )
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('users.index') }}">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Data User</span>
                    </a>
                </li><!-- End Profile Page Nav -->
            @endif

        <!-- User Page Nav (only visible for "Admin" and "Himma") -->
        @if(session('user.role') == 'Admin' )
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('mahasiswa.index') }}">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li><!-- End Profile Page Nav -->

        @endif

        @if(session('user.role') == 'Admin' || session('user.role') == 'Himma')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('lomba.index') }}">
                        <i class="bi bi-star-fill"></i>
                        <span>Data Lomba</span>
                    </a>
                </li><!-- End F.A.Q Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('topik.index') }}">
                        <i class="bi bi-lightbulb-fill"></i>
                        <span>Data Topik</span>
                    </a>
                </li><!-- End Contact Page Nav -->
            @endif

        @if(session('user.role') == 'Dosen')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('lomba.index') }}">
                    <i class="bi bi-star-fill"></i>
                    <span>Data Lomba</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->
        @endif


        @if(session('user.role') == 'Admin' || session('user.role') == 'Himma' || session('user.role') == 'Dosen')
        <li class="nav-heading">Halaman Transaksi</li>
        @endif

        @if(session('user.role') == 'Mahasiswa')
        <li class="nav-heading">Halaman Mahasiswa</li>
        @endif

        @if(session('user.role') == 'Admin' || session('user.role') == 'Himma' || session('user.role') == 'Dosen')
            <li class="nav-item">
                @if(session('user.role') == 'Admin')
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.indexadmin') }}">
                @elseif(session('user.role') == 'Dosen')
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.indexdosen') }}">
                @else
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.index') }}">
                @endif
                    <i class="bi bi-bookmark-check-fill"></i>
                    <span>Data Pendaftaran</span>
                </a>
            </li><!-- End Data Pendaftaran Page Nav -->
        @if(session('user.role') == 'Dosen')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('dosen.index') }}">
                        <i class="bi bi-bookmark-check-fill"></i>
                        <span>Data Pengajuan</span>
                    </a>
                </li><!-- End Contact Page Nav -->
                @endif
            @endif

        @if(session('user.role') == 'Admin' || session('user.role') == 'Himma')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/viewSertifikat">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>Sertifikat Lomba</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->
            @endif

        @if(session('user.role') == 'Mahasiswa')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.create') }}">
                        <i class="bi bi-star-fill"></i>
                        <span>Pendaftaran Lomba</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->
            @endif

        @if(session('user.role') == 'Mahasiswa')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.index') }}">
                        <i class="bi bi-bookmark-check-fill"></i>
                        <span>Informasi Lomba</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->
            @endif
            
        @if(session('user.role') == 'Mahasiswa')

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('minat.create') }}">
                    <i class="bi bi-file-earmark-person"></i>
                        <span>Minat</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.createsertifikat') }}">
                        <i class="bi bi-award-fill"></i>
                        <span>Sertifikat</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('portofolio.create') }}">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span>Portofolio</span>
                    </a>
                </li><!-- End Error 404 Page Nav -->
            @endif


            <!-- Laporan Page Nav (only visible for "Admin") -->
        @if(session('user.role') == 'Admin')
                <li class="nav-heading">Halaman Laporan</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('pendaftaran.laporan') }}">
                        <i class="bi bi-clipboard-data-fill"></i>
                        <span>Histori Lomba</span>
                    </a>
                </li><!-- End Register Page Nav -->
            @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('auth.login') }}">
            <i class="bi bi-box-arrow-left"></i>
            <span>Keluar</span>
        </a>
    </li>
</ul>

</aside><!-- End Sidebar-->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i>
    </a>

    <script>
        var title = document.title;
        console.log(title);
    </script>
