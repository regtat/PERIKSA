@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-50" style="border-radius:15px; background-color: rgba(217, 181, 221, 0.7);">
        <div class="card-body px-4">
            <h5 class="card-title text-center mb-4">PROFIL</h5>
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" style="border-radius:10px;" readonly>
                </div>
                <div class="mb-4">
                    <label for="nim" class="form-label"><strong>NIM</strong></label>
                    <input type="text" name="nim" class="form-control" id="nim" value="{{ $user->mahasiswa->nim }}" style="border-radius:10px;" readonly>
                </div>
                <div class="mb-4">
                    <label for="nama" class="form-label"><strong>Nama</strong></label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ $user->mahasiswa->nama }}" style="border-radius:10px;" readonly>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label"><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Buat password minimal 8 karakter, dengan kombinasi angka dan simbol" style="border-radius:10px;">
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label"><strong>Confirm Password</strong></label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Konfirmasi password baru" style="border-radius:10px;">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" style="border-radius: 8px; background-color: black !important; color: white !important; height:40px; width: 98px;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
