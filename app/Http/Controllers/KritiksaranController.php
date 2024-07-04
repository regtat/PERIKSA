<?php

namespace App\Http\Controllers;

use App\Models\Kritiksaran;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
//import Facades Storage

use Barryvdh\DomPDF\Facade\Pdf;


class KritiksaranController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'KRITIK SARAN';
    }
    public function index(Request $request): View
    {
        //get all kritiksarans

        $title = $this->title;
        $query = Kritiksaran::query();

        // Filter berdasarkan bulan yang dipilih (jika ada)
        if (Auth::user()->nip != null || Auth::user()->nim == null) {
            if ($request->has('month') && !empty($request->month)) {
                $query->whereMonth('created_at', $request->month);
            }
        }

        // Ambil data dengan pagination
        $kritiksarans = $query->latest()->paginate(10);

        // Tentukan view berdasarkan role
        if (Auth::user()->nim != null) {
            return view('mahasiswa.kritiksarans.index', compact('kritiksarans', 'title'));
        } elseif (Auth::user()->nip != null) {
            return view('wd.kritiksarans', compact('kritiksarans', 'title'));
        } else {
            return view('admin.kritiksarans', compact('kritiksarans', 'title'));
        }
    }

    public function cetak(Request $request)
    {
        //ambil nilai parameter bulan dari request
        $month = $request->get('month');

        //konversi ke int
        $month = (int) $month;

        //ambil data kritik saran yang sesuai dengan bulan (created_at) yang dipilih
        $data = Kritiksaran::whereMonth('created_at', $month)->get();

        //library Barryvdh\DomPDF\Facade\Pdf, muat view dengan data dan bulan ke file pdf
        $pdf = Pdf::loadView('wd.cetakKritikSaran', compact('data', 'month'));
        $pdf->setPaper('A4', 'portrait');
        //pdf bs diunduh
        return $pdf->stream('kritiksaran.pdf');
    }


    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $title = $this->title;
        return view('mahasiswa.kritiksarans.create', compact('title'));
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
            'k_nim' => Auth::user()->nim,
            // 'nama' => '|min:3',
            'kritiksaran' => 'required',

        ]);
        $nim = Auth::user()->nim;
        //create kritiksaran
        Kritiksaran::create([

            'k_nim' => $nim,
            // 'nama' => $request->nama,
            'kritiksaran' => $request->kritiksaran,

        ]);

        //redirect to index
        return redirect()->route('mahasiswa.kritiksarans.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get product by ID
        $kritiksaran = Kritiksaran::findOrFail($id);
        $title = $this->title;
        //render view with product
        return view('mahasiswa.kritiksarans.show', compact('kritiksarans', 'title'));
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
        $kritiksarans = kritiksaran::findOrFail($id);
        $title = $this->title;
        //render view with kritiksaran
        return view('mahasiswa.kritiksarans.edit', compact('kritiksarans', 'title'));
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
        //validate form
        $request->validate([
            'kritiksaran' => 'required',
        ]);

        //get kritiksaran by ID
        $kritiksarans = Kritiksaran::findOrFail($id);

        //update kritiksaran with new data
        $kritiksarans->update([
            // 'nama' => $request->nama,
            'kritiksaran' => $request->kritiksaran,
        ]);

        //redirect to index
        if (Auth::user()->nim != null) {
            return redirect()->route('mahasiswa.kritiksarans.index')->with(['success' => 'Data Berhasil Diubah!']);
        } elseif (Auth::user()->nip != null) {
            return redirect()->route('wd.kritiksarans')->with(['success' => 'Data Berhasil Diubah!']);
        } else {
            return redirect()->route('admin.kritiksarans')->with(['success' => 'Data Berhasil Diubah!']);
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
        //get product by ID
        $kritiksarans = Kritiksaran::findOrFail($id);


        //delete product
        $kritiksarans->delete();

        //redirect to index
        return redirect()->route('mahasiswa.kritiksarans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}