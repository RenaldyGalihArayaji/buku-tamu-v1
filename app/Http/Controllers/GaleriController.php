<?php

namespace App\Http\Controllers;

use App\Models\M_acara;
use App\Models\M_galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class GaleriController extends Controller
{

    public function index()
    {
        $galeri = M_galeri::with('acara')->orderBy('created_at', 'desc')->get();
        return view('galeri.index', [
            "title" => "Galeri",
            "galeri" => $galeri
        ]);
    }

    public function create()
    {
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('galeri.create', [
            'title' => 'Tambah Galeri',
            'acara' => $acara
        ]);
    }


    public function store(Request $request)
    {
        $validasi = Validator::class::make($request->all(), [
            'file_foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_foto' => 'required',

        ], [
            'file_foto.required' => 'Foto galeri wajib diisi',
            'file_foto.image' => 'File harus berupa gambar',
            'file_foto.mimes' => 'File harus berupa gambar dengan format: jpeg, png, jpg',
            'file_foto.max' => 'Ukuran file maksimal 2MB',
            'jenis_foto.required' => 'Jenis foto wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            $acara = M_acara::where('user_id', Auth::user()->id)->first();

            $fileName = null;
            if ($request->hasFile('file_foto')) {
                $file = $request->file('file_foto');
                $fileName = 'galeri_' . time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('galeri', $file, $fileName);
            }

            M_galeri::create([
                'acara_id' => $acara->id,
                'is_featured' => $request->is_featured,
                'jenis_foto' => $request->jenis_foto,
                'file_foto' => $fileName,
            ]);

            Alert::success('Sukses', 'Data Berhasil ditambahkan!');
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil ditambahkan!'
            ]);
        }
    }


    public function edit(string $id)
    {
        $galeri = M_galeri::findOrFail($id);
        $acara = M_acara::where('user_id', Auth::user()->id)->first();
        return view('galeri.edit', [
            'title' => 'Edit Galeri',
            'galeri' => $galeri,
            'acara' => $acara
        ]);
    }


    public function update(Request $request, string $id)
    {
        $validasi = Validator::class::make($request->all(), [
            'file_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_foto' => 'required',

        ], [
            'file_foto.image' => 'File harus berupa gambar',
            'file_foto.mimes' => 'File harus berupa gambar dengan format: jpeg, png, jpg',
            'file_foto.max' => 'Ukuran file maksimal 2MB',
            'jenis_foto.required' => 'Jenis foto wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validasi->errors()
            ]);
        } else {
            $galeri = M_galeri::findOrFail($id);

            $fileName = $galeri->file_foto; // Simpan nama file lama
            if ($request->hasFile('file_foto')) {
                // Hapus file lama jika ada
                if ($fileName && Storage::disk('public')->exists('galeri/' . $fileName)) {
                    Storage::disk('public')->delete('galeri/' . $fileName);
                }

                $file = $request->file('file_foto');
                $fileName = 'galeri_' . time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('galeri', $file, $fileName);
            }

            $galeri->update([
                'is_featured' => $request->is_featured,
                'jenis_foto' => $request->jenis_foto,
                'file_foto' => $fileName,
            ]);

            Alert::success('Sukses', 'Data Berhasil diperbarui!');
            return response()->json([
                'status' => 200,
                'message' => 'Data Berhasil diperbarui!'
            ]);
        }
    }


    public function destroy(string $id)
    {
        $galeri = M_galeri::findOrFail($id);
        if ($galeri->file_foto && Storage::disk('public')->exists('galeri/' . $galeri->file_foto)) {
            Storage::disk('public')->delete('galeri/' . $galeri->file_foto);
        }
        $galeri->delete();
        return redirect()->back();
    }
}
