@extends('layouts.app')
<style>
    .container{
    display: flex;
    flex-direction: column;
        justify-content: center;
        
}

#tabel {
  font-family: 'Poppins', sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tabel td, #tabel th {
  border: 1px solid black;
  padding: 10px;
  vertical-align: middle; /*isi kolom tengah vertikal*/
}

#tabel tr:nth-child(even) {
  background-color: #E6E6FA;
}

#tabel th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #EED3E6;
  color: black;
  border-top: none; /*hapus garis atas tabel*/
}
</style>

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mt-5">
        <strong><h2>AKUN</h2></strong>
        <a href="/user/create">
            <button style="border-radius: 11px; background-color: black !important; color: white !important; height: 43px; width: 175px">Tambah Akun</button>
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table id="tabel" class="table mt-3">
        <thead>
            <tr>
                <th style="width:auto;">Email</th>
                <th >Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td style="text-align:center; width:auto;">{{ $user->email }}</td>
                    <td scope="col">{{ $user->password }}</td>
                    <td style="text-align:center;">
                        <a href="{{ route('user.edit', $user->id) }}">
                            <button style=" align-items: center; align-items: center; "><svg xmlns="http://www.w3.org/2000/svg" width="35px" height="35px" viewBox="0 0 24 24"><g fill="none" stroke="#4ECB71" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1l1-4Z"/></g></svg></button>
                        </a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('delete')
                            <button type="submit" style="align-items: center; ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 24 24">
                                <path fill="#EB0202" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z"/>
                            </svg>
                        </button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
