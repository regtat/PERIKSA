<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\WD;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class UserController extends Controller
{
    use ValidatesRequests;
    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'AKUN';
    }
    public function index(): View
    {
        $title = $this->title;
        //relasi/join
        /*$users = User::with('mahasiswa')->latest()->paginate(5);
        return view('user.index', compact('users', 'title'));*/
        $users = User::latest()->paginate(5);
        return view('admin.user.index', compact('users', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        $title = $this->title;
        return view('admin.user.create', compact('title'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        //create
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Ditambahkan']);
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
        $title = $this->title;
        //render view user
        return view('admin.user.edit', compact('users', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'string',
            'email' => 'email',
            // 'password' => 'nullable|min:8',
        ]);

        $users = User::find($id);

        //update user
        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => $request->password,
        ]);
        $mahasiswa = Mahasiswa::where('nim', $users->nim)->first();
        $wd = WD::where('nip', $users->nip)->first();
        if ($mahasiswa) {
            $mahasiswa->update([
                'nama' => $request->name,
            ]);
        }
        if ($wd) {
            $wd->update([
                'nama' => $request->name,
            ]);
        }
        return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //get user by id
        $users = User::findOrFail($id);
        //delete
        $users->delete();
        $mahasiswa = Mahasiswa::where('nim', $users->nim)->first();
        $wd = WD::where('nip', $users->nip)->first();
        if ($mahasiswa) {
            $mahasiswa->delete();
        }
        if ($wd) {
            $wd->delete();
        }

        return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Dihapus']);
    }

}