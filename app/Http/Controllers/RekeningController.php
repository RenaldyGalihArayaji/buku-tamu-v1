<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use App\Models\M_rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RekeningController extends Controller
{
    public function index()
    {
        $rekening = M_rekening::with('acara')->orderBy('id', 'DESC')->get();
        return view('rekening.index', [
            'title' => 'Data Rekening',
            'rekening' => $rekening
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('rekening.create', [
            'title' => 'Tambah Data Rekening',
            'acara' => $acara
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama_bank' => 'required',
            'nomor_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
             $acara = M_acara::where('user_id', Auth::user()->id)->first();
             M_rekening::create([
                'acara_id' => $acara->id,
                'nama_bank' => $request->nama_bank,
                'nomor_rekening' => $request->nomor_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                'is_active' => $request->is_active
             ]);

             Alert::success('Sukses','Data berhasil ditambahkan');
             return response()->json([
                'status' => 200,
                'message' => 'Data berhasil ditambahkan'
             ]);
        }
        
    }

    public function edit(string $id)
    {
        $rekening = M_rekening::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('rekening.edit',[
            'rekening' => $rekening,
            'acara' => $acara
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validasi = Validator::make($request->all(), [
            'nama_bank' => 'required',
            'nomor_rekening' => 'required|numeric',
            'nama_pemilik_rekening' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
             $acara = M_acara::where('user_id', Auth::user()->id)->first();
             $rekening = M_rekening::findOrFail($id);

             $rekening->update([
                'acara_id' => $acara->id,
                'nama_bank' => $request->nama_bank,
                'nomor_rekening' => $request->nomor_rekening,
                'nama_pemilik_rekening' => $request->nama_pemilik_rekening,
                'is_active' => $request->is_active
             ]);

             Alert::success('Sukses','Data berhasil diperbarui');
             return response()->json([
                'status' => 200,
                'message' => 'Data berhasil diperbarui'
             ]);
        }
    }

    public function destroy(string $id)
    {
        $rekening = M_rekening::findOrFail($id);
        $rekening->delete();
        return redirect()->back();
    }
}
