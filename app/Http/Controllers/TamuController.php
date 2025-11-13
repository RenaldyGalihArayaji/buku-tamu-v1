<?php

namespace App\Http\Controllers;

use App\Models\M_tamu;
use App\Models\M_acara;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class TamuController extends Controller
{

    public function index()
    {
        $tamu = M_tamu::with('acara')->orderBy('created_at', 'desc')->get();

        return view('tamu.index', [
            'title' => 'Data Tamu',
            'tamu' => $tamu
        ]);
    }

    public function create()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('tamu.create', [
            'title' => 'Tambah Tamu',
            'acara' => $acara
        ]);
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kategori_tamu' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'numeric',
            'email' => 'nullable|email:dns|unique:users'
        ]);

        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            M_tamu::create([
                'acara_id' => $acara->id,
                'qr_code' => 'UND-' . Str::upper(Str::random(8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')),
                'kategori_tamu' => $request->kategori_tamu,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);

            Alert::success('Sukses', 'Data Berhasil ditambahkan');
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil ditambahkan'
            ]);
        }
    }

    public function show(string $id)
    {
        $tamu = M_tamu::findOrFail($id);
        return view('tamu.show', [
            'title' => 'Edit Detail Tamu',
            'tamu' => $tamu
        ]);
    }

    public function edit(string $id)
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        $tamu = M_tamu::findOrFail($id);
        return view('tamu.edit', [
            'title' => 'Edit Tamu',
            'acara' => $acara,
            'tamu' => $tamu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'kategori_tamu' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'numeric',
            'email' => 'nullable|email:dns|unique:users'
        ]);

        $tamu = M_tamu::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            $tamu->update([
                'acara_id' => $acara->id,
                'kategori_tamu' => $request->kategori_tamu,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);

            Alert::success('Sukses', 'Data Berhasil diperbarui');
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil diperbarui'
            ]);
        }
    }

    public function destroy(string $id)
    {
        $tamu = M_tamu::findOrFail($id);
        $tamu->delete();
        return redirect()->back();
    }
}
