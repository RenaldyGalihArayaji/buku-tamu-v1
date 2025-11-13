<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AcaraController extends Controller
{
    public function index()
    {
        // Mengambil data acara berdasarkan user yang login
        $acara = M_acara::where('user_id', Auth::id())->first();

        return view('acara.index', [
            'title' => 'Data Acara',
            'acara' => $acara
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mempelai_pria' => 'required|string|max:255',
            'nama_mempelai_wanita' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'deskripsi_acara' => 'nullable|string'
        ], [
            'nama_mempelai_pria.required' => 'Nama mempelai pria wajib diisi',
            'nama_mempelai_wanita.required' => 'Nama mempelai wanita wajib diisi',
            'nama_acara.required' => 'Nama acara wajib diisi',
            'tanggal_acara.required' => 'Tanggal acara wajib diisi',
            'tanggal_acara.date' => 'Format tanggal tidak valid'
        ]);

        try {
            // Cek apakah user sudah memiliki acara
            $existingAcara = M_acara::where('user_id', Auth::id())->first();
            if ($existingAcara) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah memiliki acara yang terdaftar'
                ]);
            }

            // Buat acara baru
            $acara = new M_acara();
            $acara->user_id = Auth::id();
            $acara->kode_acara = 'ACR-' . strtoupper(Str::random(8));
            $acara->nama_mempelai_pria = $request->nama_mempelai_pria;
            $acara->nama_mempelai_wanita = $request->nama_mempelai_wanita;
            $acara->nama_acara = $request->nama_acara;
            $acara->tanggal_acara = $request->tanggal_acara;
            $acara->deskripsi_acara = $request->deskripsi_acara;
            $acara->save();

            Alert::success('Sukses', 'Data acara berhasil disimpan');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan data');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_mempelai_pria' => 'required|string|max:255',
            'nama_mempelai_wanita' => 'required|string|max:255',
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'deskripsi_acara' => 'nullable|string'
        ], [
            'nama_mempelai_pria.required' => 'Nama mempelai pria wajib diisi',
            'nama_mempelai_wanita.required' => 'Nama mempelai wanita wajib diisi',
            'nama_acara.required' => 'Nama acara wajib diisi',
            'tanggal_acara.required' => 'Tanggal acara wajib diisi',
            'tanggal_acara.date' => 'Format tanggal tidak valid'
        ]);

        try {
            // Cek kepemilikan acara
            $acara = M_acara::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Update data acara
            $acara->nama_mempelai_pria = $request->nama_mempelai_pria;
            $acara->nama_mempelai_wanita = $request->nama_mempelai_wanita;
            $acara->nama_acara = $request->nama_acara;
            $acara->tanggal_acara = $request->tanggal_acara;
            $acara->deskripsi_acara = $request->deskripsi_acara;
            $acara->save();

            Alert::success('Sukses', 'Data acara berhasil diperbarui');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui data');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $acara = M_acara::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        $acara->delete();
        return redirect()->back();
    }
}
