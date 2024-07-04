<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    use ValidatesRequests;
    protected $mahasiswa;
    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'Mahasiswa';
    }


    public function index(): View
    {
        $mahasiswa = Mahasiswa::latest()->paginate(10);
        $title = $this->title;
        return view('admin.mahasiswa.index', compact('mahasiswa', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.mahasiswa.create', compact('title'));
    }


    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nim' => 'required|string|size:9',
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        //create
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
        ]);
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nim' => $request->nim,
            'name' => $request->nama,
        ]);
        return redirect()->route('admin.mahasiswa.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nim): View
    {
        //get mahasiwsa by nim
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $title = $this->title;
        //render view mahasiswa
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim): RedirectResponse
    {
        $this->validate($request, [
            'nama' => 'string',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($nim);
        //update mahasiswa
        $mahasiswa->update([
            'nama' => $request->nama,
        ]);
        $user = User::where('nim', $nim)->firstOrFail();  //cari user berdasarkan nim dari $nim yg dikirim
        $user->update([
            'name' => $request->nama,
        ]);
        return redirect()->route('admin.mahasiswa.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nim): RedirectResponse
    {
        //get mahasiswa by nim
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $user = User::where('nim', $nim)->firstOrFail();
        //delete
        $mahasiswa->delete();
        $user->delete();
        return redirect()->route('admin.mahasiswa.index')->with(['success' => 'Data Berhasil Dihapus']);
    }

}
