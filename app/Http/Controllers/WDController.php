<?php

namespace App\Http\Controllers;

use App\Models\WD;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class WDController extends Controller
{
    use ValidatesRequests;
    protected $wd;
    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'Wakil Dekan';
    }

    public function index(): View
    {
        $wd = WD::latest()->paginate(5);
        $title = $this->title;
        return view('admin.wd.index', compact('wd', 'title'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.wd.create', compact('title'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nip' => 'required|string|size:18',
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        //create
        WD::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
        ]);
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nip' => $request->nip,
            'name' => $request->nama,
        ]);
        return redirect()->route('admin.wd.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $nip)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nip): View
    {
        //get wd by nip
        $wd = WD::findOrFail($nip);
        $title = $this->title;
        //render view
        return view('admin.wd.edit', compact('wd', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nip): RedirectResponse
    {
        $this->validate($request, [
            'nama' => 'string',
        ]);

        $wd = WD::findOrFail($nip);

        //update wd
        $wd->update([
            'nama' => $request->nama,
        ]);
        $user = User::where('nip', $nip)->firstOrFail();  //cari user berdasarkan nim dari $nim yg dikirim
        $user->update([
            'name' => $request->nama,
        ]);
        return redirect()->route('admin.wd.index')->with(['success' => 'Data Berhasil Diubah']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip): RedirectResponse
    {
        //get wd by nim
        $wd = WD::findOrFail($nip);
        //delete
        $wd->delete();

        return redirect()->route('admin.wd.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}