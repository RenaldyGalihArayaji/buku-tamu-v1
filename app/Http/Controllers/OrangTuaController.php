<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use App\Models\M_orang_tua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OrangTuaController extends Controller
{
    public function index()
    {
        $orangTua = M_orang_tua::orderBy('created_at', 'desc')->get();
        return view('orang_tua.index',[
            'title' => 'Data Orang Tua',
            'orangTua' => $orangTua
        ]);
    }


    public function create()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('orang_tua.create',[
            'title' => 'Tambah Data Orang Tua',
            'acara' => $acara
        ]);
    }


    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'jenis_orang_tua' => 'required|in:MEMPELAI_PRIA,MEMPELAI_WANITA',
            'jenis' => 'required|in:AYAH,IBU',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'masih_hidup' => 'required|boolean',
        ]);

        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            M_orang_tua::create([
                'acara_id' => $acara->id,
                'jenis_orang_tua' => $request->jenis_orang_tua,
                'jenis' => $request->jenis,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'masih_hidup' => $request->masih_hidup
            ]);

           Alert::success('Sukses', 'Data berhasil ditambahkan');
           return response()->json(['status' => 200, 'message' => 'Data berhasil ditambahkan']);
        }
        
    }

   
    public function edit(string $id)
    {
        $orangTua = M_orang_tua::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('orang_tua.edit',[
            'title' => 'Edit Data Orang Tua',
            'orangTua' => $orangTua,
            'acara' => $acara
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validasi = Validator::make($request->all(), [
            'jenis_orang_tua' => 'required|in:MEMPELAI_PRIA,MEMPELAI_WANITA',
            'jenis' => 'required|in:AYAH,IBU',
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'masih_hidup' => 'required|boolean',
        ]);

        $orangTua = M_orang_tua::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            $orangTua->update([
                'acara_id' => $acara->id,
                'jenis_orang_tua' => $request->jenis_orang_tua,
                'jenis' => $request->jenis,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'masih_hidup' => $request->masih_hidup
            ]);

            Alert::success('Sukses', 'Data berhasil diperbarui');
            return response()->json(['status' => 200, 'message' => 'Data berhasil diperbarui']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orangTua = M_orang_tua::findOrFail($id);
        $orangTua->delete();

        return redirect()->back();
    }
}
