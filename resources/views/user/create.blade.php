@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card w-45 px-4 py-3" style="border-radius:15px; background-color: rgba(217, 181, 221, 0.7);">
        <div class="card-body pl-10">
            <h5 class="card-title text-center pb-3"><strong>AKUN</strong></h5>
            <form method="post" action="{{ route('user.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="nim" required class="form-label" style="font: weight 50px;">Nama</label>
                    <select class="form-select border-radius:50px" aria-label="Default select example" name="nim">
                    <option selected disabled>Pilih nama</option>
                    @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->nim}}">{{$mhs->nama}}</option>
                    @endforeach
                    
                    </select>
                    @error('nim')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" style="font: weight 50px;">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="mhs.ft@mhs.unsoed.ac.id" value="{{ old('email') }}" style="width:100%; border-radius:10px;">
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Buat password minimal 8 karakter" value="{{ old('password') }}"  style="width:300px; border-radius:10px;">
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div >
                    <button type="submit" style="border-radius: 8px; background-color: black !important; color: white !important; height:40px; width: 98px">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
