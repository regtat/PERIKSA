@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-50 px-4 py-3" style="border-radius:15px; background-color: rgba(217, 181, 221, 0.7);">
        <div class="card-body pl-10">
            <h5 class="card-title text-center pb-3">Mahasiswa</h5>
            <form method="post" action="{{ route('mahasiswa.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" id="nim" placeholder="H1D022001" value="{{ old('nim') }}" style="width: 110px; border-radius:10px;">
                    @error('nim')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}"  style="border-radius:10px;">
                    @error('nama')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex">
                    <button type="submit" style="border-radius: 8px; background-color: black !important; color: white !important; height:40px; width: 98px">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
