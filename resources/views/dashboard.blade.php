@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
<link href="assets/img/ASCI Web.png" rel="icon">
<style>
    .table-rounded {
    border-radius: 50px; /* Atur radius sesuai keinginan */
}

</style>

<!-- Main -->
<main id="main" class="main">
@if(session('user.role') == 'Admin' || session('user.role') == 'Himma' || session('user.role') == 'Dosen')

        <section class="section dashboard">

            
                <div class="row">
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
                                    <a href="{{ route('lomba.index') }}" class="small-box-footer">Selengkapnya<i class="bi bi-arrow-right-circle"></i></a>
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
    </section>
@endif

<!-- Include Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>


<section class="section mahasiswa-dashboard">
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="card mahasiswa-card">
                <div class="card-body">
                    <h5 class="card-title">Lomba Yang Tersedia</h5>
                    <div class="form-group">
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($lombas as $key => $competition)
                                        @php
                                            $today = \Carbon\Carbon::today();
                                            $startDate = \Carbon\Carbon::parse($competition->lb_tglmulai);
                                            $endDate = \Carbon\Carbon::parse($competition->lb_tglselesai);
                                            $isOngoing = $today->between($startDate, $endDate);
                                            $isOver = $today->gt($endDate);
                                            $isPast = $today->gt($endDate);
                                        @endphp
                                    @if($competition->lb_status == 1 && !$isPast)
                                        <div class="carousel-item @if($key === 0) active @endif">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img src="{{ 'sertifikat/'.$competition->lb_gambar }}" class="d-block w-75 fixed-image-size">
                                                </div>
                                                <div class="col-md-6">
                                                <table class="table table-bordered table-striped table-rounded" style="background-color: #e3f2fd;">

                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 150px;"><strong>Judul Lomba</strong></td>
                                                                <td>{{ $competition->lb_judul }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tingkat Lomba</strong></td>
                                                                <td>
                                                                    @if($competition->lb_tingkat === 0)
                                                                        Internal Kampus
                                                                    @elseif($competition->lb_tingkat === 1)
                                                                        Regional
                                                                    @elseif($competition->lb_tingkat === 2)
                                                                        Nasional
                                                                    @elseif($competition->lb_tingkat === 3)
                                                                        Internasional
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @if($competition->topik)
                                                                <tr>
                                                                    <td><strong>Topik</strong></td>
                                                                    <td>{{ $competition->topik->tp_nama }}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td><strong>Tanggal Mulai</strong></td>
                                                                <td>{{ $startDate->format('Y-m-d') }}</td> 
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tanggal Selesai</strong></td>
                                                                <td>{{ $endDate->format('Y-m-d') }}</td> 
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status Lomba</strong></td>
                                                                <td>
                                                                    @if ($isOngoing)
                                                                        <span>Sedang Berlangsung</span>
                                                                    @elseif ($isOver)
                                                                        <span>Sudah Lewat</span>
                                                                    @else
                                                                        <!-- Add specific styling for other status if needed -->
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <!-- Add more rows for other details -->
                                                        </tbody>
                                                    </table>
                                                    @if(session('user.role') == 'Mahasiswa')
                                                        <a href="{{ route('pendaftaran.create', ['selectedCompetition' => $competition->id]) }}" class="btn btn-primary float-right">Daftar Lomba</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
</main><!-- End #main -->
