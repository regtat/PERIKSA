<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use ValidatesRequests;
    protected $admin;
    protected $title;   //title bs diakses oleh metode dalam class yang sama atau class turunannya
    public function __construct()
    {
        $this->title = 'Admin';
    }
    // {
    //     $this->admin = new adminModel();
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(): View|RedirectResponse
    {
        $admin = Admin::latest()->paginate(5);
        $title = $this->title;
        if (Auth::user()->nim != null && Auth::user()->nip != null) {
            return redirect()->route('admin.admins.index', compact('admins', 'title'));
        } else {
            return view('/');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.admins.create', compact('title'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        //create
        Admin::create([
            'nama' => $request->nama,
        ]);
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->nama,
        ]);
        return redirect()->route('admin.admins.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        //get mahasiwsa by id
        $admin = Admin::findOrFail($id);
        $title = $this->title;
        //render view admin
        return view('admin.admins.edit', compact('admin', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'nama' => 'string',
        ]);

        $admin = Admin::findOrFail($id);

        //update admin
        $admin->update([
            'nama' => $request->nama,
        ]);
        return redirect()->route('admin.admins.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //get admin by id
        $admin = Admin::findOrFail($id);
        //delete
        $admin->delete();

        return redirect()->route('admin.admins.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
