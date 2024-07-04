<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Pengaduan;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
//import Facades Storage
use Illuminate\Support\Facades\Storage;


class PengaduanController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'PENGADUAN';
    }

    public function index(): View
    {
        //get all pengaduan

        $title = $this->title;

        if (Auth::user()->nim != null) {
            $pengaduans = Pengaduan::latest()->get();
            return view('mahasiswa.pengaduans.index', compact('pengaduans', 'title'));
        } elseif (Auth::user()->nip != null) {
            $pengaduans = Pengaduan::latest()->paginate(2);
            return view('wd.pengaduans', compact('pengaduans', 'title'));
        } else {
            $pengaduans = Pengaduan::latest()->paginate(2);
            return view('admin.pengaduans', compact('pengaduans', 'title'));
        }
    }


    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $title = $this->title;
        return view('mahasiswa.pengaduans.create', compact('title'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'p_nim' => Auth::user()->nim,
            'pengaduan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'in:Diproses,Menunggu,Selesai',
            'tanggal' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}$/'],

        ]);

        //ambil nim dari user
        $nim = Auth::user()->nim;
        //upload image
        $foto = $request->file('foto');
        $foto->storeAs('public/pengaduan', $foto->hashName());

        //create product
        Pengaduan::create([
            'pengaduan' => $request->pengaduan,
            'p_nim' => $nim,
            'foto' => $foto->hashName(),
            'status' => $request->status ?? 'Menunggu', //set default status 'menunggu' if not provided
            'tanggal' => $request->tanggal,
        ]);

        //redirect to index
        return redirect()->route('mahasiswa.pengaduans.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id)
    {

    }


    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $pengaduans = Pengaduan::findOrFail($id);

        $title = $this->title;
        //render view with pengaduans
        if (Auth::user()->nim != null) {
            return view('mahasiswa.pengaduans.edit', compact('pengaduans', 'title'))->with(['success' => 'Data Berhasil Diubah!']);
        }
        if (Auth::user()->nip != null) {
            return view('wd.pengaduans', compact('pengaduans', 'title'))->with(['success' => 'Data Berhasil Diubah!']);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        if (Auth::user()->nim != null) {
            //validate form
            $request->validate([

                'pengaduan' => 'string',
                'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
                'status' => 'in:Diproses,Menunggu,Selesai',
                'tanggal' => ['regex:/^\d{4}-\d{2}-\d{2}$/'],
            ]);

            //get pengaduan by ID
            $pengaduans = Pengaduan::findOrFail($id);

            //check if image is uploaded
            if ($request->hasFile('foto')) {

                //upload new image
                $foto = $request->file('foto');
                $foto->storeAs('public/pengaduan', $foto->hashName());

                //delete old image
                Storage::delete('public/pengaduan/' . $pengaduans->foto);

                //update kritiksaran with new data
                $pengaduans->update([
                    // 'p_nim'          => $request->nim,
                    'pengaduan' => $request->pengaduan,
                    'foto' => $foto->hashName(),
                    // 'status'        => $request->status,
                    'tanggal' => $request->tanggal,
                    // 'id'=> $request->id,
                ]);
            } else {
                //update kritiksaran without changing the image
                $pengaduans->update([
                    // 'p_nim'          => $request->nim,
                    // 'id' => $request->id,
                    'pengaduan' => $request->pengaduan,
                    // 'status'        => $request->status,
                    'tanggal' => $request->tanggal,
                ]);
            }

            //redirect to index
            return redirect()->route('mahasiswa.pengaduans.index')->with(['success' => 'Data Berhasil Diubah!']);
        }
        if (Auth::user()->nip != null) {
            //validate form
            $request->validate([
                'status' => 'required|in:Diproses,Menunggu,Selesai',
            ]);

            //get pengaduan by ID
            $pengaduans = Pengaduan::findOrFail($id);

            //check if image is uploaded
            if ($request->hasFile('foto')) {

                //upload new image
                $foto = $request->file('foto');
                $foto->storeAs('public/pengaduan', $foto->hashName());

                //delete old image
                Storage::delete('public/pengaduan/' . $pengaduans->foto);

                //update status with new data
                $pengaduans->update([
                    'status' => $request->status,
                ]);
            } else {
                //update kritiksaran without changing the image
                $pengaduans->update([
                    'status' => $request->status,
                ]);
            }

            //redirect to index
            return redirect()->route('wd.pengaduans')->with(['success' => 'Data Berhasil Diubah!']);
        }

    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $pengaduans = Pengaduan::findOrFail($id);
        $pengaduans->delete();
        if (Auth::user()->nim != null) {
            return redirect()->route('mahasiswa.pengaduans.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } elseif (Auth::user()->nip != null) {
            return redirect()->route('wd.pengaduans')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('admin.pengaduans')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $request->validate(['status' => 'required|in:Diproses,Menunggu,Selesai']);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return redirect()->route('wd.pengaduans')->with(['success' => 'Status Berhasil Diubah!']);
    }

}
