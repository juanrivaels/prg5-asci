@extends('layouts.app')

@section('title', 'Update Topik')

@section('contents')

<!-- Main -->
<main id="main" class="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Update Topik</h5>

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
            <form action="{{ route('topik.update', ['id' => $topik->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                <label for="tp_nama">Nama Topik<span style="color: red">*</span></label>
                <input name="tp_nama" id="tp_nama" placeholder="Nama Topik" class="form-control" value="{{ $topik->tp_nama }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('topik.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</main>
<!-- End - Main -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

@endsection
