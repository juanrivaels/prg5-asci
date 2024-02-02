@extends('layouts.app')

@section('title','Pengajuan Lomba')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Pengajuan Bimbingan</h5>
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
            <form action="{{ route('pengajuan.index') }}" method="post" enctype="multipart/form-data">
                @csrf

                
                <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pn_idpendaftaran" class="form-label">Pendaftaran<span style="color: red">*</span></label>
                        <select class="form-select" name="pn_idpendaftaran" id="pn_idpendaftaran" onchange="updateFields()" required>
                            <option value="">Pilih Pendaftaran</option>
                            @foreach($pendaftarans as $p)
                                @if(in_array($p->pd_status, [3, 4, 5, 6]) && $p->pd_userid == session('user.id'))
                                    <option value="{{ $p->id }}" data-id-dosen="{{ $p->pd_iddosen }}" data-id-lomba="{{ $p->pd_idlomba }}">
                                        {{ $p->lomba->lb_judul }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                
                <input type="hidden" id="pn_idlomba" name="pn_idlomba">
                <input type="hidden" id="pn_iddosen" name="pn_iddosen">
                <input for="pn_userid" type="hidden" id="pn_userid" name="pn_userid" value="{{ session('user.id') }}">



                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pn_namamahasiswa" class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="pn_namamahasiswa" name="pn_namamahasiswa" value="{{ session('user.name') }}" readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pn_revisimahasiswa" class="form-label">Alasan</label>
                        <textarea class="form-control" id="pn_revisimahasiswa" name="pn_revisimahasiswa" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="pn_tglpengajuan">Tanggal Pengajuan<span style="color: red">*</span></label>
                        <input type="datetime-local" name="pn_tglpengajuan" id="pn_tglpengajuan" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
                <a href="{{ route('pengajuan.create') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
function updateFields() {
    var selectedOption = document.getElementById("pn_idpendaftaran");

    var idDosen = selectedOption.options[selectedOption.selectedIndex].getAttribute("data-id-dosen");
    var idLomba = selectedOption.options[selectedOption.selectedIndex].getAttribute("data-id-lomba");

    console.log("ID Dosen:", idDosen);
    console.log("ID Lomba:", idLomba);

    document.getElementById("pn_iddosen").value = idDosen;
    document.getElementById("pn_idlomba").value = idLomba;
}
</script>




@endsection
