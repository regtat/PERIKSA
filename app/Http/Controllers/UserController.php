<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\User;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class UserController extends Controller
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
    public function index(): View
    {
        //relasi/join
        $users = User::with('mahasiswa')->latest()->paginate(5);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $mahasiswa=MahasiswaModel::all();
        return view('user.create', compact('mahasiswa'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nim'=>'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:50',
        ]);
        //create
        User::create([
            'nim'=>$request->nim,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan']);
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
    public function edit(string $id): View
    {
        //get mahasiwsa by nim
        $users = User::findOrFail($id);
        //render view mahasiswa
        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email|max:50',
            'password' => 'nullable|min:8|max:50',
        ]);

        $users = User::find($id);

        //update mahasiswa
        $users->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //get user by nim
        $users = User::findOrFail($id);
        //delete
        $users->delete();

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
