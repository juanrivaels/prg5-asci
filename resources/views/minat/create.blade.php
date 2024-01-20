@extends('layouts.app')

@section('title','Input Minat')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Input Minat</h5>
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
            <form action="{{ route('minat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                <label for="mn_idtopik" class="form-label">Topik<span style="color: red">*</span></label>
                <select class="form-select" name="mn_idtopik" id="mn_idtopik" required>
                    <option value="">Pilih Topik</option>
                    @foreach($topiks as $t)
                    @if($t->tp_status == 1)
                        <option value="{{ $t->id }}">{{ $t->tp_nama }}</option>
                    @endif
                    @endforeach
                </select>

                <input for="mn_iduser" type="hidden" id="mn_iduser" name="mn_iduser" value="{{ session('user.id') }}">

                <div class="mb-3">
                    <label for="mn_minat" class="form-label">Alasan<span style="color: red">*</span></label>
                    <textarea class="form-control" name="mn_minat" id="mn_minat" rows="4" required></textarea>
                </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</main>
<!-- End - Main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@endsection
