@extends('layouts.app')

@section('title', 'Edit Student')

@section('contents')
<link href="assets/img/ASCI Web.png" rel="icon">

<!-- Main -->
<main id="main" class="main">
@if(session('user.role') == 'Admin' || session('user.role') == 'Himma' || session('user.role') == 'Dosen')
<section class="section dashboard">
      <div class="row">
                      <!-- Sales Card -->
                      <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Lomba Akademik</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-star"></i>
                                </div>
                                <div class="ps-3">
                                    <h1> {{ $totalAkademik }}</h1>
                                    <a href="{{ route('lomba.index') }}" class="small-box-footer">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sales Card -->

                                <!-- Non Akademik Card -->
                                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Lomba Non Akademik <span></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-star"></i>
                                </div>
                                <div class="ps-3">
                                    <h1> {{ $totalNonAkademik }}</h1>
                                    <a href="{{ route('lomba.index') }}" class="small-box-footer">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Revenue Card -->


                <div class="col-xxl-4 col-md-6">
                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Status <span>| Pendaftaran</span></h5>
                            <div class="activity">
                              <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                    Pendaftar Menunggu <a class="fw-bold text-dark"> Konfirmasi </a>
                                </div>
                            </div><!-- End activity item-->
                            
                            <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    Pengajuan Lomba <a class="fw-bold text-dark">Ditolak</a>
                                </div>
                            </div><!-- End activity item-->
                            
                            <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                    Pengajuan Lomba <a class="fw-bold text-dark">Diterima</a>
                                </div>
                            </div><!-- End activity item-->
                            
                            </div>
                            </br>
                            <a href="{{ url('/viewPendaftaran') }}" class="small-box-footer">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                        </div>
                    </div>
                    <!-- End Recent Activity -->
                </div>

                <div class="col-xxl-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Status <span>| Lomba</span></h5>
                            <div class="activity">
                              <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    Peserta Lomba Masuk Babak <a class="fw-bold text-dark">Penyisihan</a>
                                </div>
                            </div><!-- End activity item-->
                            
                            <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                    Peserta Masuk Babak <a class="fw-bold text-dark">Final</a>
                                </div>
                            </div><!-- End activity item-->
                            
                            <div class="activity-item d-flex">
                                <div class="activite-label"></div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Lomba yang telah <a class="fw-bold text-dark">Selesai</a>
                                </div>
                            </div><!-- End activity item-->
                            
                            </div>
                            </br>
                            <a href="{{ url('/viewPendaftaran') }}" class="small-box-footer">Selengkapnya <i class="bi bi-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Rekomendasi Sales -->
                <div class="col-lg-12">
                    <div class="card recent-sales overflow-auto">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH JUARA -->
                <!-- column chart -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Diagram Juara</h5>
                            <br />
                            <div class="filter">
                                <a class="icon" data-bs-toggle="dropdown">FILTER <i class="bi bi-filter"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#" onclick="filterData('DST')">Seluruh Diagram</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#" onclick="filterData('customYear')">Custom Tahun</a></li>
                                    @php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear + 1; $year >= $currentYear - 5; $year--) {
                                            echo '<li><a class="dropdown-item" href="#" onclick="filterData(' . $year . ')">' . $year . '</a></li>';
                                        }
                                    @endphp
                                </ul>
                            </div>
                            <!-- Column Chart -->
                            <div id="columnChart"></div>
                            <script>
                                function filterData(filterType) {
                                        console.log(filterType);
                                        if (filterType === 'DST') {
                                            getData("getAllSertifikat");
                                        } else if (filterType === 'customYear') {
                                            var currentYear = new Date().getFullYear();
                                            var selectedYear = prompt("Enter the custom year:", currentYear);
                                            getData("getTotalSertifikatByYear?tahun=" + selectedYear);
                                        } else {
                                            getData("getTotalSertifikatByYear?tahun=" + filterType);
                                        }
                                    }

                                    function getData(url) {
                                        if (document.querySelector("#columnChart").hasChildNodes()) {
                                            document.querySelector("#columnChart").innerHTML = '';
                                        }
                                        $.ajax({
                                            url: "http://localhost:8080/" + url,
                                            method: "GET",
                                            success: function (data) {
                                                var arrJuara1 = Array(12).fill(0);
                                                var arrJuara2 = Array(12).fill(0);
                                                var arrJuara3 = Array(12).fill(0);
                                                var totalJuara = 0;

                                                for (var i = 0; i < data.length; i++) {
                                                    var tanggal = data[i].tanggal;
                                                    var itemYear = new Date(tanggal).getFullYear();
                                                    var itemMonth = new Date(tanggal).getMonth();

                                                    if (data[i].juara == '1') {
                                                        arrJuara1[itemMonth]++;
                                                        totalJuara++;
                                                    } else if (data[i].juara == '2') {
                                                        arrJuara2[itemMonth]++;
                                                        totalJuara++;
                                                    } else if (data[i].juara == '3') {
                                                        arrJuara3[itemMonth]++;
                                                        totalJuara++;
                                                    }
                                                }

                                                var chartOptions = {
                                                    series: [
                                                        {
                                                            name: 'Juara 1',
                                                            data: arrJuara1,
                                                        },
                                                        {
                                                            name: 'Juara 2',
                                                            data: arrJuara2,
                                                        },
                                                        {
                                                            name: 'Juara 3',
                                                            data: arrJuara3,
                                                        },
                                                    ],
                                                    chart: {
                                                        type: 'bar',
                                                        height: 430,
                                                    },
                                                    plotOptions: {
                                                        bar: {
                                                            horizontal: false,
                                                            columnWidth: '55%',
                                                            endingShape: 'rounded',
                                                        },
                                                    },
                                                    dataLabels: {
                                                        enabled: false,
                                                    },
                                                    stroke: {
                                                        show: true,
                                                        width: 4,
                                                        colors: ['transparent'],
                                                    },
                                                    xaxis: {
                                                        categories: [
                                                            'Jan',
                                                            'Feb',
                                                            'Mar',
                                                            'Apr',
                                                            'May',
                                                            'Jun',
                                                            'Jul',
                                                            'Aug',
                                                            'Sep',
                                                            'Oct',
                                                            'Nov',
                                                            'Dec',
                                                        ],
                                                    },
                                                    yaxis: {
                                                        title: {
                                                            text: 'Jumlah Pemenang',
                                                        },
                                                        labels: {
                                                            formatter: function (value) {
                                                                return Math.round(value);
                                                            },
                                                        },
                                                        forceNiceScale: true,
                                                    },
                                                    fill: {
                                                        opacity: 1,
                                                    },
                                                    tooltip: {
                                                        y: {
                                                            formatter: function (val) {
                                                                return +val + ' Juara';
                                                            },
                                                        },
                                                    },
                                                };
                                                var chart = new ApexCharts(
                                                    document.querySelector('#columnChart'),
                                                    chartOptions
                                                );
                                                chart.render();

                                                document.getElementById('totalJuara').innerText = totalJuara;
                                            },
                                        });
                                    }

                                    $(document).ready(function () {
                                        getData("getAllSertifikat");
                                    });
                            </script>
                            <br/>
                            <div class="d-flex justify-content-center">
                                <h5 class="card-title">
                                    Total Peserta yang Mendapat Juara
                                    <span class="badge bg-info text-light" id="totalJuara"></span>
                                </h5>
                            </div>
                            <!-- End Column Chart -->
                        </div>        
    </section>
@endif

<!-- Include Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>

@if(session('user.role') == 'Mahasiswa')
    <section class="section mahasiswa-dashboard">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="card mahasiswa-card">
                    <div class="card-body">
                        <h5 class="card-title">Lomba Yang Tersedia</h5>

                        <!-- Image Carousel -->

                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($lombas as $key => $competition)
                                <div class="carousel-item @if($key === 0) active @endif">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ 'sertifikat/'.$competition->lb_gambar }}" class="d-block w-75 fixed-image-size" >
                                    </div>
                                        <div class="col-md-6">
                                            <p>Judul Lomba: {{ $competition->lb_judul }}</p>
                                            @if($competition->topik)
                                                <p>Topik: {{ $competition->topik->tp_nama }}</p>
                                            @endif
                                            <p>Tanggal Mulai: {{ $competition->lb_tglmulai }}</p>
                                            <p>Tanggal Selesai: {{ $competition->lb_tglselesai }}</p>
                                            <p>
                                                Kategori: 
                                                @if ($competition->lb_kategori == 0)
                                                    Akademik
                                                @else
                                                    Non Akademik
                                                @endif
                                            </p>
                                            <p>
                                                Jenis: 
                                                @if ($competition->lb_jenis == 0)
                                                    Individu
                                                @elseif ($competition->lb_jenis == 1)
                                                    Kelompok
                                                @else
                                                    Individu dan Kelompok
                                                @endif
                                            </p>
                                            <p>
                                                Tingkatan: 
                                                @if ($competition->lb_tingkatan == 0)
                                                    Internal Kampus
                                                @elseif ($competition->lb_tingkatan == 1)
                                                    Regional
                                                @elseif ($competition->lb_tingkatan == 2)
                                                    Nasional
                                                @else
                                                    Internasional
                                                @endif
                                            </p>
                                            <p>Penyelenggara: {{ $competition->lb_penyelenggara }}</p>
                                            <p>
                                                Pelaksanaan: 
                                                @if ($competition->lb_pelaksanaan == 0)
                                                    Offline
                                                @else
                                                    Online
                                                @endif
                                            </p>
                                            <p>Lokasi: {{ $competition->lb_lokasi }}</p>
                                            <p>Deskripsi: {{ $competition->lb_deskripsi }}</p>
                                            <a href="{{ route('pendaftaran.create', ['selectedCompetition' => $competition->id]) }}" class="btn btn-primary float-right">Daftar Lomba</a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="text-center mt-3">
                        <button id="prevBtn" type="button" class="btn btn-primary mr-2"> < </button>
                        <button id="nextBtn" type="button" class="btn btn-primary"> > </button>
                        
                    </div>
                    

                    </div>
                </div>
            </div>
            <!-- End Mahasiswa Card -->
        </div>

    </section>  
<script>
    $(document).ready(function () {
        // Enable carousel controls
        $('#prevBtn').click(function () {
            $('#imageCarousel').carousel('prev');
        });
        $('#nextBtn').click(function () {
            $('#imageCarousel').carousel('next');
        });
    });

    $(document).ready(function () {
        // Update Mahasiswa Information Card on carousel slide
        $('#imageCarousel').on('slide.bs.carousel', function (event) {
            var index = event.to;
            $('.competition-info').removeClass('active');
            $('.competition-info[data-index="' + index + '"]').addClass('active');
        });
    });
</script>

@endif   
</main><!-- End #main -->
