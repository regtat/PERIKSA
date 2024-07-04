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


//import Facades Storage
use Illuminate\Support\Facades\Storage;


class WD3peController extends Controller
{
    /**
     * index
     *
     * @return void
     */


    public function index() : View
    {
        return view('landingpage');
    }



    // /**
    //  * store
    //  *
    //  * @param  mixed $request
    //  * @return RedirectResponse
    //  */
    // public function store(Request $request): RedirectResponse
    // {
    //     //validate form
    //     $request->validate([
    //         'NIM'           => 'required|min:9',
    //         'pengaduan'     => 'required',
    //         'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
    //         'status'        => 'required|in:diproses,menunggu,selesai',
    //         'tanggal'    => ['required', 'regex:/^\d{4}-\d{2}-\d{2}$/'],
            
    //     ]);

    //     //upload image
    //     $foto = $request->file('foto');
    //     $foto->storeAs('public/WD3pe', $foto->hashName());

    //     //create product
    //     Pengaduan::create([
            
    //         'NIM'          => $request->NIM,
    //         'pengaduan'    => $request->pengaduan,
    //         'foto'         => $foto->hashName(),
    //         'status'       => $request->status,
    //         'tanggal'      => $request->tanggal,

    //     ]);

    //     //redirect to index
    //     return redirect()->route('WD3pes.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    //  /**
    //  * edit
    //  *
    //  * @param  mixed $id
    //  * @return View
    //  */
    // public function edit(string $id): View
    // {
    //     //get product by ID
    //     $pengaduan = Pengaduan::findOrFail($id);

    //     $title = $this->title;
    //     //render view with kritiksaran
    //     return view('pengaduans.edit', compact('pengaduan', 'title'));
    // }
        
    // /**
    //  * update
    //  *
    //  * @param  mixed $request
    //  * @param  mixed $id
    //  * @return RedirectResponse
    //  */
    // public function update(Request $request, $id): RedirectResponse
    // {
    //     //validate form
    //     $request->validate([
    //         // 'NIM'           => 'required|min:9',
    //         // 'pengaduan'     => 'required',
    //         // 'foto'          => 'required|image|mimes:jpeg,jpg,png|max:2048',
    //         'status'        => 'required|in:diproses,menunggu,selesai',
    //         // 'tanggal'    => ['required', 'regex:/^\d{4}-\d{2}-\d{2}$/'],
    //     ]);
    
    //     //get kritiksaran by ID
    //     $pengaduan = Pengaduan::findOrFail($id);
    
    //     //check if image is uploaded
    //     if ($request->hasFile('foto')) {

    //         //upload new image
    //         $foto = $request->file('foto');
    //         $foto->storeAs('public/pengaduans', $foto->hashName());
    
    //         //delete old image
    //         Storage::delete('public/pengaduans/'.$pengaduan->foto);
    
    //         //update kritiksaran with new data
    //         $pengaduan->update([
    //             // 'NIM'          => $request->NIM,
    //             // 'nama'         => $request->nama,
    //             // 'pengaduan'    => $request->pengaduan,
    //             // 'foto'         => $foto->hashName(),
    //             'status'        => $request->status,
    //             // 'tanggal'    => $request->tanggal,
                
    //         ]);
    //     } else {
    //         //update kritiksaran without changing the image
    //         $pengaduan->update([
    //             // 'NIM'          => $request->NIM,
    //             // 'nama'         => $request->nama,
    //             // 'pengaduan'    => $request->pengaduan,
    //             'status'        => $request->status,
    //             // 'tanggal'    => $request->tanggal,
    //         ]);
    //     }

    //     //redirect to index
    //     return redirect()->route('WD3pes.index')->with(['success' => 'Data Berhasil Diubah!']);
    // }

    // /**
    //  * destroy
    //  *
    //  * @param  mixed $id
    //  * @return RedirectResponse
    //  */
    // public function destroy($id): RedirectResponse
    // {
    //     //get product by ID
    //     $pengaduans = Pengaduan::findOrFail($id);

    //     //delete product
    //     $pengaduans->delete();

    //     //redirect to index
    //     return redirect()->route('WD3pes.index')->with(['success' => 'Data Berhasil Dihapus!']);
    // }
}
