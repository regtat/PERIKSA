@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
<div class="card w-50 " style="border-radius:15px; background-color: rgba(217, 181, 221, 0.7);">
        <div class="card-body">
            <h5 class="card-title text-center">AKUN</h5>
                <form method="post" action="{{ route('user.update', $users->id) }}">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="email" class="form-label">Email </label>
                        <input type="email" name="email" class="form-control " id="email" value="{{old('email', $users->email)}}" style="width: 259px; border-radius:10px;" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Buat password minimal 8 karakter, dengan kombinasi angka dan simbol" value="{{ old('password', $users->password) }}" style="border-radius:10px;">
                        @error('password')
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
