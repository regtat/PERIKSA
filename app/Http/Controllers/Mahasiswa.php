<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class Mahasiswa extends Controller
{
    use ValidatesRequests;
    // protected $mahasiswa;
    // public function __construct()
    // {
    //     $this->mahasiswa = new MahasiswaModel();
    // }
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $mahasiswa=MahasiswaModel::latest()->paginate(5);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nim'=>'required|string|size:9',
            'nama'=>'required|string|max:50',
        ]);
        //create
        MahasiswaModel::create([
            'nim'=>$request->nim,
            'nama'=>$request->nama,
        ]);
        return redirect()->route('mahasiswa.index')->with(['success'=>'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nim): View
    {
        //get mahasiwsa by nim
        $mahasiswa=MahasiswaModel::findOrFail($nim);
        //render view mahasiswa
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nim): RedirectResponse
    {
        $this->validate($request, [
            'nama'=>'required|string|max:50',
        ]);

        $mahasiswa=MahasiswaModel::findOrFail($nim);

        //update mahasiswa
        $mahasiswa->update([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('mahasiswa.index')->with(['success'=>'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nim): RedirectResponse
    {
        //get mahasiswa by nim
        $mahasiswa=MahasiswaModel::findOrFail($nim);
        //delete
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with(['success'=>'Data Berhasil Dihapus']);
    }
}
