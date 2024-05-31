@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
<div class="card w-50 " style="border-radius:15px; background-color: rgba(217, 181, 221, 0.7);">
        <div class="card-body">
            <h5 class="card-title text-center">Mahasiswa</h5>
                <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM </label>
                        <input type="text" name="nim" class="form-control " id="nim" value="{{old('nim', $mahasiswa->nim)}}" style="width: auto; border-radius:10px;" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Lengkap" value="{{ old('nama', $mahasiswa->nama) }}" style="border-radius:10px;">
                        @error('nama')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" style="border-radius: 8px; background-color: black !important; color: white !important; height:40px; width: 98px">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
