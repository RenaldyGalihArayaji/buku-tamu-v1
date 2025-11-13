<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use Illuminate\Http\Request;
use App\Models\M_detail_acara;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DetailAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_acara = M_detail_acara::with('acara')->orderBy('created_at', 'desc')->get();
        return view('detail_acara.index', [
            'title' => 'Detail Acara',
            'detail_acara' => $detail_acara
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('detail_acara.create', [
            'title' => 'Tambah Detail Acara',
            'acara' => $acara
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'nama_detail_acara' => 'required',
            'alamat_detail_acara' => 'required',
            'lokasi_detail_acara' => 'required',
            'tanggal_detail_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai'
        ]);

        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            M_detail_acara::create([
                'acara_id' => $acara->id,
                'nama_detail_acara' => $request->nama_detail_acara,
                'alamat_detail_acara' => $request->alamat_detail_acara,
                'lokasi_detail_acara' => $request->lokasi_detail_acara,
                'tanggal_detail_acara' => $request->tanggal_detail_acara,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'deskripsi_detail_acara' => $request->deskripsi_detail_acara
            ]);

            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return response()->json(['status' => 200, 'message' => 'Data berhasil ditambahkan']);
        }
        
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
    public function edit(string $id)
    {
        $detail_acara = M_detail_acara::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('detail_acara.edit', [
            'title' => 'Edit Detail Acara',
            'detail_acara' => $detail_acara,
            'acara' => $acara
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validasi = Validator::make($request->all(),[
            'nama_detail_acara' => 'required',
            'alamat_detail_acara' => 'required',
            'lokasi_detail_acara' => 'required',
            'tanggal_detail_acara' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai'
        ]);

        $detail_acara = M_detail_acara::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
             $detail_acara->update([
                'acara_id' => $acara->id,
                'nama_detail_acara' => $request->nama_detail_acara,
                'alamat_detail_acara' => $request->alamat_detail_acara,
                'lokasi_detail_acara' => $request->lokasi_detail_acara,
                'tanggal_detail_acara' => $request->tanggal_detail_acara,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'deskripsi_detail_acara' => $request->deskripsi_detail_acara
            ]);

            Alert::success('Berhasil', 'Data berhasil diperbarui');
            return response()->json(['status' => 200, 'message' => 'Data berhasil diperbarui']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail_acara = M_detail_acara::findOrFail($id);
        $detail_acara->delete();

        return redirect()->back();
    }
}
